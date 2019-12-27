<?php

use Saritasa\LaravelHealthCheck\Checkers\DatabaseHealthChecker;

return [
    'checkers' => [
        'database' => DatabaseHealthChecker::class,
    ],
];
