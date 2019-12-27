<?php

namespace Saritasa\LaravelHealthCheck\Checkers;

use Saritasa\LaravelHealthCheck\Contracts\CheckResultContract;

/**
 * Contract for services which checks
 */
interface ServiceHealthCheckerContract
{
    /**
     * Returns health checking result.
     *
     * @return CheckResultContract
     */
    public function check(): CheckResultContract;
}
