<?php

namespace Saritasa\LaravelHealthCheck;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Saritasa\LaravelHealthCheck\Checkers\HealthCheckersFactory;
use Saritasa\LaravelHealthCheck\Contracts\CheckResult;

final class HealthChecker
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
     * @param HealthCheckersFactory $checkersFactory Health checkers factory
     * @param array $availableCheckers Available checkers list
     */
    public function __construct(HealthCheckersFactory $checkersFactory, array $availableCheckers)
    {
        $this->checkersFactory = $checkersFactory;
        $this->availableCheckers = $availableCheckers;
    }

    /**
     * Returns health checks of or available service in application.
     *
     * @return Collection|CheckResult[]
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
     * @return CheckResult
     *
     * @throws InvalidArgumentException
     * @throws BindingResolutionException
     */
    public function check(string $type): CheckResult
    {
        if (!in_array($type, $this->availableCheckers)) {
            throw new InvalidArgumentException();
        }

        return $this->checkersFactory->build($type)->check();
    }
}
