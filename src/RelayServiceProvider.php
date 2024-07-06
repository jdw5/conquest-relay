<?php

namespace Conquest\Relay;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RelayServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('relay')
            ->hasConfigFile();
    }

    public function boot()
    {
        parent::boot();
    }

    // public function register(): void
    // {
    //     $this->app->singleton(Relay::class);
    // }
}
