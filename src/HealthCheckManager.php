<?php

namespace Saritasa\LaravelHealthCheck;

use Illuminate\Contracts\Container\BindingResolutionException;
use InvalidArgumentException;
use Saritasa\LaravelHealthCheck\Checkers\HealthCheckersFactory;
use Saritasa\LaravelHealthCheck\Contracts\CheckResultContract;
use Illuminate\Support\Collection;

final class HealthCheckManager
{
    /**
     * Health checkers instances factory.
     *
     * @var HealthCheckersFactory
     */
    private $checkersFactory;

    /**
     * Available health checkers.
     *
     * @var string[]
     */
    private $availableCheckers;

    /**
     * HealthCheckManager constructor.
     *
     * @param HealthCheckersFactory $checkersFactory
     * @param array $availableCheckers
     */
    public function __construct(HealthCheckersFactory $checkersFactory, array $availableCheckers)
    {
        $this->checkersFactory = $checkersFactory;
        $this->availableCheckers = $availableCheckers;
    }

    /**
     * Returns health checks of or available service in application.
     *
     * @return Collection|CheckResultContract[]
     *
     * @throws BindingResolutionException
     */
    public function checkAll(): Collection
    {
        $results = collect();

        foreach ($this->availableCheckers as $type) {
            $results->push($this->checkersFactory->build($type)->check());
        }

        return $results;
    }

    /**
     * Returns health check of specific service.
     *
     * @param string $type Type of service to health check it
     *
     * @return CheckResultContract
     *
     * @throws InvalidArgumentException
     * @throws BindingResolutionException
     */
    public function check(string $type): CheckResultContract
    {
        if (!in_array($type, $this->availableCheckers)) {
            throw new InvalidArgumentException();
        }

        return $this->checkersFactory->build($type)->check();
    }
}
