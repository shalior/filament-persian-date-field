<?php

declare(strict_types=1);

namespace Shalior\FilamentPersianDateField\Components;

use Carbon\CarbonInterface;
use Closure;
use Filament\Forms\Components\Field;
use Illuminate\Support\Carbon;

class PersianDatePicker extends Field
{
    protected string $view = 'filament-persian-date-field::components.persian-date-picker';

    protected CarbonInterface|string|Closure|null $maxDate = null;
    protected CarbonInterface|string|Closure|null $minDate = null;

    protected bool | Closure $isWithoutTime = false;
    protected bool | Closure $isWithoutSeconds = false;

    protected string | Closure | null $format = null;

    protected bool | Closure $isWithoutDate = false;
    protected string | Closure $viewMode = 'day';

    protected function setUp(): void
    {
        parent::setUp();

        $this->afterStateHydrated(static function (PersianDatePicker $component, $state): void {
            if (! $state instanceof CarbonInterface) {
                $state = Carbon::parse($state);
            }

            $state->setTimezone(config('app.timezone'));
            $state = $state->format($component->getFormat());

            $component->state($state);
        });

        $this->dehydrateStateUsing(static function (PersianDatePicker $component, $state) {
            if (blank($state)) {
                return null;
            }

            if (! $state instanceof CarbonInterface) {
                $state = Carbon::parse($state);
            }

            $state->setTimezone(config('app.timezone'));

            return $state->format($component->getFormat());
        });

        $this->rule(
            'date',
        );
    }

    public function maxDate(CarbonInterface|string|Closure|null $date, $acceptEqual = true): static
    {
        $this->maxDate = $date;

        $rule = $acceptEqual ? 'before_or_equal' : 'before';

        $this->rule(static function (PersianDatePicker $component) use ($rule) {
            return "{$rule}:{$component->getMaxDate()}";
        }, static fn (PersianDatePicker $component): bool => (bool) $component->getMaxDate());

        return $this;
    }

    public function minDate(CarbonInterface | string | Closure | null $date, $acceptEqual = true): static
    {
        $this->minDate = $date;

        $rule = $acceptEqual ? 'after_or_equal' : 'after';

        $this->rule(static function (PersianDatePicker $component) use ($rule) {
            return "{$rule}:{$component->getMinDate()}";
        }, static fn (PersianDatePicker $component): bool => (bool) $component->getMinDate());

        return $this;
    }

    public function getMaxDate(): ?string
    {
        return (string) $this->evaluate($this->maxDate);
    }

    public function getMinDate(): ?string
    {
        return (string) $this->evaluate($this->minDate);
    }

    public function viewMode(string | Closure $viewMode = 'day'): static
    {
        $this->viewMode = $viewMode;

        return $this;
    }

    public function withoutSeconds(bool | Closure $condition = true): static
    {
        $this->isWithoutSeconds = $condition;

        return $this;
    }

    public function withoutTime(bool | Closure $condition = true): static
    {
        $this->isWithoutTime = $condition;

        return $this;
    }

    public function hasSeconds(): bool
    {
        return ! $this->isWithoutSeconds;
    }

    public function hasTime(): bool
    {
        return ! $this->isWithoutTime;
    }

    public function format(string | Closure | null $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat(): string
    {
        $format = $this->evaluate($this->format);

        if ($format) {
            return $format;
        }

        $format = 'Y-m-d';

        if (! $this->hasTime()) {
            return $format;
        }

        $format = "{$format} H:i";

        if (! $this->hasSeconds()) {
            return $format;
        }

        return "{$format}:s";
    }

    public function getJsFormat(): ?string
    {
        $phpFormat = $this->getFormat();
        $jsFormat = str_replace('Y', 'YYYY', $phpFormat);
        $jsFormat = str_replace('m', 'MM', $jsFormat);
        $jsFormat = str_replace('d', 'DD', $jsFormat);
        $jsFormat = str_replace('H', 'HH', $jsFormat);
        $jsFormat = str_replace('i', 'mm', $jsFormat);
        $jsFormat = str_replace('s', 'ss', $jsFormat);
        $jsFormat = str_replace('-', '/', $jsFormat);

        return $jsFormat;
    }

    public function getViewMode()
    {
        $viewMode = $this->evaluate($this->viewMode);

        if (! in_array($viewMode, ['day', 'month', 'year'])) {
            $viewMode = 'day';
        }

        return $viewMode;
    }
}
