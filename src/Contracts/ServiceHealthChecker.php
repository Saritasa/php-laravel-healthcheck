<?php

namespace Saritasa\LaravelHealthCheck\Contracts;

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
