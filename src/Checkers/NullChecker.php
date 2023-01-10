<?php

namespace Saritasa\LaravelHealthCheck\Checkers;

use Saritasa\LaravelHealthCheck\Contracts\CheckResult;
use Saritasa\LaravelHealthCheck\Contracts\ServiceHealthChecker;

/**
 * Does nothing. Use if you need to test HTTP server availability only.
 */
class NullChecker implements ServiceHealthChecker
{
    /**
     * {@inheritDoc}
     */
    public function check(): CheckResult
    {
        return new HealthCheckResultDto(null, true);
    }
}
