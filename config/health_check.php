<?php

use Saritasa\LaravelHealthCheck\Checkers\DatabaseHealthChecker;
use Saritasa\LaravelHealthCheck\Checkers\RedisHealthChecker;
use Saritasa\LaravelHealthCheck\Checkers\S3HealthChecker;

return [
    'checkers' => [
        'database' => DatabaseHealthChecker::class,
        'redis' => RedisHealthChecker::class,
        's3' => S3HealthChecker::class,
    ],
];
