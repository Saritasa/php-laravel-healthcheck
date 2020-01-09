<?php

namespace Saritasa\LaravelHealthCheck\Checkers;

use Saritasa\LaravelHealthCheck\Contracts\CheckResult;

/**
 * Contract for services which checks
 */
interface ServiceHealthChecker
{
    /**
     * Returns health checking result.
     *
     * @return CheckResult
     */
    public function check(): CheckResult;
}
