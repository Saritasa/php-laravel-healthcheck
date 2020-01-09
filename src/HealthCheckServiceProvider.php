<?php

namespace Saritasa\LaravelHealthCheck;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Saritasa\LaravelHealthCheck\Checkers\HealthCheckersFactory;


/**
 * Package providers. Registers package implementation in DI container.
 * Make settings needed to correct work.
 */
class HealthCheckServiceProvider extends ServiceProvider
{
    /**
     * Register package implementation in DI container.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(HealthChecker::class, function (Container $container) {
            $healthCheckersFactory = $container->make(HealthCheckersFactory::class);

            $checkersConfig = $this->app['config']->get('health_check.checkers');

            foreach ($checkersConfig as $type => $checkerClass) {
                $healthCheckersFactory->register($type, $checkerClass);
            }

            return new HealthChecker($healthCheckersFactory, array_keys($checkersConfig));
        });
    }

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
            'health_check'
        );
        $this->mergeConfigFrom(__DIR__ . '/../config/health_check.php', 'health_check');
        $this->loadRoutesFrom(__DIR__. '/../routes/api.php');
    }
}
