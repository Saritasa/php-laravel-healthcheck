<?php

namespace Saritasa\LaravelHealthCheck\Checkers;

use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Cache;
use Saritasa\LaravelHealthCheck\Contracts\CheckResult;

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
        
        return new HealthCheckResultDto([
            HealthCheckResultDto::IS_SUCCESS => $isSuccess,
            HealthCheckResultDto::TYPE => 'redis',
            HealthCheckResultDto::MESSAGE => $errorMessage,
        ]);
    }
}
