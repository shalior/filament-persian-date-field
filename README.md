# A FilamentPhp form field to pick persian (jalali) dates

[![Latest Version on Packagist](https://img.shields.io/packagist/v/shalior/filament-persian-date-field.svg?style=flat-square)](https://packagist.org/packages/shalior/filament-persian-date-field)
[![Total Downloads](https://img.shields.io/packagist/dt/shalior/filament-persian-date-field.svg?style=flat-square)](https://packagist.org/packages/shalior/filament-persian-date-field)

![filament-demo](https://user-images.githubusercontent.com/42506404/165785421-338f2b0a-8995-40e5-9c37-33c3a3cd9736.png)

## Installation

You can install the package via composer:

```bash
composer require shalior/filament-persian-date-field
```

**_To use with filament v2 use version ^1_**

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-persian-date-field-config"
```

## Usage

You'll use this component with [Filament forms](https://filamentphp.com/docs/2.x/forms/installation). 

It syncs the related gregorian date (as string: `Y-m-d`) with your LiveWire component.
Use the field like any other filament form fields:

```php
    protected function getFormSchema(): array
    {
        return [
            \Shalior\FilamentPersianDateField\Components\PersianDatePicker::make('persianDate')
            ->id('persian-date')
            ->maxDate(now()->format('Y-m-d'))
            ->minDate(now()->subWeek()->format('Y-m-d'))
            ->withoutTime()
            ->viewMode('month') // accepts 'day', 'month', 'year'
            ->default('2022-04-28'),
        ];
    }
```

## Persian date table column

You can use this field as a column in your table:

The column assumes you've installed [verta](https://github.com/hekmatinasser/verta) or [morilog/jalali](https://github.com/morilog/jalali)
if neither of them is installed, it will use Carbon's `translatedFormat()`

```php
    Shalior\FilamentPersianDateField\Columns::make('created_at')
        ->translateLabel()
        ->format('Y/m/d') // default is 'H:i:s Y/m/d'
        ->timeZone('Asia/Tehran'), // default is 'Asia/Tehran'
        // renders as: ۱۳۹۹/۰۸/۰۱ in the table
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

I Encourage you to do so. 

## Credits

- [Shalior](https://github.com/shalior)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
