<?php

namespace Saritasa\LaravelHealthCheck\Checkers;

use Illuminate\Support\Facades\Cache;
use Saritasa\LaravelHealthCheck\Contracts\CheckResult;
use Saritasa\LaravelHealthCheck\Contracts\ServiceHealthChecker;
use Throwable;

class RedisHealthChecker implements ServiceHealthChecker
{
    /**
     * {@inheritDoc}
     */
    public function check(): CheckResult
    {
        $isSuccess = true;
        $errorMessage = null;

        $redis = Cache::connection();

        try {
            $redis->ping();
        } catch (Throwable $exception) {
            $isSuccess = false;
            $errorMessage = $exception->getMessage();
        }

        return new HealthCheckResultDto($errorMessage, $isSuccess);
    }
}
