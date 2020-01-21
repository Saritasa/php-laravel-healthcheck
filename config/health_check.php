<?php

use Saritasa\LaravelHealthCheck\Checkers\DatabaseHealthChecker;
use Saritasa\LaravelHealthCheck\Checkers\RedisHealthChecker;

return [
    'checkers' => [
        'database' => DatabaseHealthChecker::class,
        'redis' => RedisHealthChecker::class,
    ],
];
