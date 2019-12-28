<?php

namespace Saritasa\LaravelHealthCheck\Checkers;

use Saritasa\LaravelHealthCheck\Contracts\CheckResultContract;
use Illuminate\Database\DatabaseManager;
use Throwable;

class DatabaseHealthChecker implements ServiceHealthCheckerContract
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
    public function check(): CheckResultContract
    {
        $isSuccess = true;
        $errorMessage = null;

        try {
            $this->databaseManager->reconnect();
        } catch (Throwable $exception) {
            $isSuccess = false;
            $errorMessage = $exception->getMessage();
        }

        return new HealthCheckResultDto([
            HealthCheckResultDto::IS_SUCCESS => $isSuccess,
            HealthCheckResultDto::TYPE => 'database',
            HealthCheckResultDto::MESSAGE => $errorMessage,
        ]);
    }
}
