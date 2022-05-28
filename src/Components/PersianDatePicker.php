<?php

declare(strict_types=1);

namespace Shalior\FilamentPersianDateField\Components;

use Carbon\CarbonInterface;
use Closure;
use Filament\Forms\Components\Field;

class PersianDatePicker extends Field
{
    protected string $view = 'filament-persian-date-field::components.persian-date-picker';

    protected CarbonInterface|string|Closure|null $maxDate = null;
    protected CarbonInterface|string|Closure|null $minDate = null;

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
}
