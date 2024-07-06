<?php

namespace Conquest\Text\Tests;

use Mockery;
use Inertia\ServiceProvider;
use Illuminate\Http\JsonResponse;
use Conquest\Text\TextServiceProvider;
use Orchestra\Testbench\Concerns\CreatesApplication;
use Orchestra\Testbench\TestCase as Orchestra;
use Orchestra\Testbench\Concerns\WithWorkbench;

class TestCase extends Orchestra
{    
    use WithWorkbench;
    // use CreatesApplication;
        
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class);

        $this->publishTestView();
    }
    // protected function getPackageProviders($app)
    // {
    //     return [
    //         TextServiceProvider::class,
    //         ServiceProvider::class,
    //     ];
    // }

    protected function getEnvironmentSetUp($app)
    {
        // Load your package configuration
        $app['config']->set('text', require __DIR__.'/../config/text.php');

        // Set up a basic Inertia configuration
        $app['config']->set('inertia', [
            'testing' => [
                'ensure_pages_exist' => false,
                'page_paths' => [],
                'page_extensions' => [],
            ],
        ]);

        $app['config']->set('view.paths', [
            __DIR__.'/stubs',
            resource_path('views'),
        ]);
    }

    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Http\Kernel', 'Conquest\Text\Tests\HttpKernel');
    }

    protected function publishTestView()
    {
        $viewPath = __DIR__.'/stubs/app.blade.php';
        $publishPath = base_path('resources/views/app.blade.php');

        if (!file_exists($publishPath)) {
            if (!is_dir(dirname($publishPath))) {
                mkdir(dirname($publishPath), 0755, true);
            }
            copy($viewPath, $publishPath);
        }
    }
}
