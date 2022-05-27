# A FilamentPhp form field to pick persian dates

[![Latest Version on Packagist](https://img.shields.io/packagist/v/shalior/filament-persian-date-field.svg?style=flat-square)](https://packagist.org/packages/shalior/filament-persian-date-field)
[![Total Downloads](https://img.shields.io/packagist/dt/shalior/filament-persian-date-field.svg?style=flat-square)](https://packagist.org/packages/shalior/filament-persian-date-field)

![filament-demo](https://user-images.githubusercontent.com/42506404/165785421-338f2b0a-8995-40e5-9c37-33c3a3cd9736.png)

## Installation

You can install the package via composer:

```bash
composer require shalior/filament-persian-date-field
```

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
            ->default('2022-04-28'),
        ];
    }
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
