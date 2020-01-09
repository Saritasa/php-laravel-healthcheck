<?php

namespace Saritasa\LaravelHealthCheck\Checkers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use RuntimeException;

class HealthCheckersFactory
{
    /**
     * Registered repositories.
     *
     * @var array
     */
    protected $registeredCheckers;

    /**
     * DI container instance.
     *
     * @var Container
     */
    protected $container;

    /**
     * HealthCheckersFactory constructor.
     *
     * @param Container $container DI container instance
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->registeredCheckers = new Collection();
    }

    /**
     * Builds specific health checking service by there type.
     *
     * @param string $type Type to build service
     *
     * @return ServiceHealthChecker
     *
     * @throws BindingResolutionException
     */
    public function build(string $type): ServiceHealthChecker
    {
        if (!$this->registeredCheckers->has($type)) {
            throw new InvalidArgumentException("$type ");
        }

        return $this->container->make($this->registeredCheckers->get($type));
    }

    /**
     * Registers new health checking service.
     *
     * @param string $type Type of new health checking service
     * @param string $concrete Class of service. Important: Class must extend ServiceHealthCheckerContract
     *
     * @return void
     *
     * @throws RuntimeException
     */
    public function register(string $type, string $concrete): void
    {
        if (!is_subclass_of($concrete, ServiceHealthChecker::class)) {
            throw new RuntimeException("$concrete must implement " . ServiceHealthChecker::class);
        }

        $this->registeredCheckers->put($type, $concrete);
    }
}
