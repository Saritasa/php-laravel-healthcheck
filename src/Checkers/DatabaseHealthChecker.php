<?php

namespace Saritasa\LaravelHealthCheck\Checkers;

use Illuminate\Database\DatabaseManager;
use Saritasa\LaravelHealthCheck\Contracts\CheckResult;
use Saritasa\LaravelHealthCheck\Contracts\ServiceHealthChecker;
use Throwable;

class DatabaseHealthChecker implements ServiceHealthChecker
{
    /**
     * Laravel's database manager.
     *
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * DatabaseHealthChecker constructor.
     *
     * @param DatabaseManager $databaseManager Laravel's database manager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * {@inheritDoc}
     */
    public function check(): CheckResult
    {
        $isSuccess = true;
        $errorMessage = null;

        try {
            $this->databaseManager->reconnect();
        } catch (Throwable $exception) {
            $isSuccess = false;
            $errorMessage = $exception->getMessage();
        }

        return new HealthCheckResultDto($errorMessage, $isSuccess);
    }
}
