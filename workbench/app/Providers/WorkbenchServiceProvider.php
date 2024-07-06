<?php

namespace Workbench\App\Providers;

use Mockery;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Conquest\Text\Http\Middleware\TextMiddleware;

class WorkbenchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::view('/', 'welcome');
    }
}
