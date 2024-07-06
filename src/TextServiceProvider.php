<?php

namespace Conquest\Text;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Conquest\Text\Commands\TextCommand;
use Conquest\Text\Http\Resources\LangResource;

class TextServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('text')
            ->hasConfigFile();
    }

    public function boot()
    {
        parent::boot();
        LangResource::withoutWrapping();
    }

    // public function register(): void
    // {
    //     $this->app->singleton(Text::class);
    // }
}
