<?php

namespace Saritasa\LaravelHealthCheck;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

/**
 * Package providers. Registers package implementation in DI container.
 * Make settings needed to correct work.
 */
class HealthCheckServiceProvider extends ServiceProvider
{
    /**
     * Make package settings needed to correct work.
     *
     * @return void
     *
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->publishes(
            [
                __DIR__ . '/../config/health_check.php' =>
                    $this->app->make('path.config') . DIRECTORY_SEPARATOR . 'health_check.php',
            ],
            'config'
        );
        $this->mergeConfigFrom(__DIR__ . '/../config/health_check.php', 'health_check');
        $this->loadRoutesFrom(__DIR__. '/../routes/api.php');
    }
}
