<?php

namespace Shalior\FilamentPersianDateField;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Shalior\FilamentPersianDateField\Commands\FilamentPersianDateFieldCommand;

class FilamentPersianDateFieldServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-persian-date-field')
            ->hasViews();
    }
}
