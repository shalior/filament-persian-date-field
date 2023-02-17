<?php

namespace Shalior\FilamentPersianDateField\Columns;

use Filament\Tables\Columns\Column;

class PersianDateColumn extends Column
{
    protected string $view = 'filament-persian-date-field::columns.persian-date-column';

    protected string $format = 'H:i:s Y/m/d';

    protected string $timezone = 'Asia/Tehran';

    public function format(string $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function timezone(string $timezone): static
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getTimezone()
    {
        return $this->timezone;
    }

    public function getFormattedDate()
    {
        $date = $this->getState();

        if (blank($date)) {
            return '';
        }

        // if verta function is not defined, use jdate function
        if (function_exists('verta')) {
            return verta($date, $this->getTimezone())->format($this->getFormat());
        }

        // if the class Jalalian exists use it
        if (class_exists('Morilog\Jalali\Jalalian')) {
            return \Morilog\Jalali\Jalalian::fromCarbon(Carbon::parse($date)
                ->setTimezone($this->getTimezone()))
                ->format($this->getFormat());
        }

        return Carbon::parse($date)
            ->setTimezone($this->getTimezone())
            ->translatedFormat($this->getFormat());
    }
}
