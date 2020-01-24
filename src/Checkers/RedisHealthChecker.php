<?php

namespace Saritasa\LaravelHealthCheck\Checkers;

use Illuminate\Support\Facades\Cache;
use Saritasa\LaravelHealthCheck\Contracts\CheckResult;
use Saritasa\LaravelHealthCheck\Contracts\ServiceHealthChecker;
use Throwable;

class RedisHealthChecker implements ServiceHealthChecker
{
    /**
     * Cache facade.
     *
     * @var Cache
     */
    protected $redisClient;
    
    /**
     * RedisHealthChecker constructor.
     */
    public function __construct()
    {
        $this->redisClient = Cache::connection();
    }
    
    /**
     * {@inheritDoc}
     */
    public function check(): CheckResult
    {
        $isSuccess = true;
        $errorMessage = null;
        
        try {
            $this->redisClient->ping();
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
