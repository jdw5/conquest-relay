<?php

namespace Conquest\Relay\Tests;

use Conquest\Relay\RelayServiceProvider;
use Inertia\ServiceProvider;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as Orchestra;
use Workbench\App\Providers\WorkbenchServiceProvider;

use function Orchestra\Testbench\workbench_path;

class TestCase extends Orchestra
{
    use WithWorkbench;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class);
        $this->publishTestView();
    }

    protected function getPackageProviders($app)
    {
        return [
            RelayServiceProvider::class,
            ServiceProvider::class,
            WorkbenchServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('relay', require workbench_path('config/relay.php'));

        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));

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
        $app->singleton('Illuminate\Contracts\Http\Kernel', 'Conquest\Relay\Tests\HttpKernel');
    }

    protected function publishTestView()
    {
        $viewPath = __DIR__.'/stubs/app.blade.php';
        $publishPath = base_path('resources/views/app.blade.php');

        if (! file_exists($publishPath)) {
            if (! is_dir(dirname($publishPath))) {
                mkdir(dirname($publishPath), 0755, true);
            }
            copy($viewPath, $publishPath);
        }
    }
}
