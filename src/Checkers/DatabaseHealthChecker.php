<?php

namespace Saritasa\LaravelHealthCheck\Checkers;

use Saritasa\LaravelHealthCheck\Contracts\CheckResultContract;
use Illuminate\Database\DatabaseManager;

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
        return new HealthCheckResultDto([
            HealthCheckResultDto::IS_SUCCESS => (bool)$this->databaseManager->getDatabaseName(),
            HealthCheckResultDto::TYPE => 'database',
        ]);
    }
}
