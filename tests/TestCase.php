<?php

namespace Conquest\Text\Tests;

use Conquest\Text\TextServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Inertia\ServiceProvider;
use Orchestra\Testbench\Concerns\WithWorkbench;

class TestCase extends Orchestra
{    
    use WithWorkbench;
        
    protected function setUp(): void
    {
        parent::setUp();
    }

    // protected function getPackageProviders($app)
    // {
    //     return [
    //         TextServiceProvider::class,
    //         ServiceProvider::class,
    //     ];
    // }

    // public function getEnvironmentSetUp($app)
    // {
    //     config()->set('database.default', 'testing');
    // }
}
