<?php

namespace Saritasa\LaravelHealthCheck\Checkers;

use Illuminate\Support\Facades\Storage;
use Saritasa\LaravelHealthCheck\Contracts\CheckResult;

class S3HealthChecker implements ServiceHealthChecker
{
    /**
     * S3 client.
     *
     * @var Storage
     */
    protected $s3Client;
    
    /**
     * S3HealthChecker constructor.
     *
     * @param $s3Client
     */
    public function __construct()
    {
        $this->s3Client = Storage::cloud();
    }
    
    /**
     * {@inheritDoc}
     */
    public function check(): CheckResult
    {
        $isSuccess = true;
        $errorMessage = null;
        
        try {
            $this->s3Client->directories();
        } catch (Throwable $exception) {
            $isSuccess = false;
            $errorMessage = $exception->getMessage();
        }
        
        return new HealthCheckResultDto([
            HealthCheckResultDto::IS_SUCCESS => $isSuccess,
            HealthCheckResultDto::TYPE => 's3',
            HealthCheckResultDto::MESSAGE => $errorMessage,
        ]);
    }
}
