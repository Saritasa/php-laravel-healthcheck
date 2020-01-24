<?php

namespace Saritasa\LaravelHealthCheck\Tests;

use Exception;
use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Saritasa\LaravelHealthCheck\Checkers\DatabaseHealthChecker;

/**
 * Class DatabaseCheckerTest
 *
 * @package Saritasa\LaravelHealthCheck\Tests
 */
class DatabaseCheckerTest extends TestCase
{
    /**
     * Database manager mock.
     *
     * @var MockInterface|DatabaseManager
     */
    protected $databaseManager;
    
    /**
     * Database connection mock.
     *
     * @var MockInterface|Connection
     */
    protected $connection;
    
    /**
     * Setup tests setting.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->databaseManager = Mockery::mock(DatabaseManager::class);
        $this->connection = Mockery::mock(Connection::class);
    }
    
    /**
     * Test check when database unavailable.
     */
    public function testCheckFail(): void
    {
        $this->databaseManager->shouldReceive('reconnect')->andThrow(new Exception());
        $databaseChecker = new DatabaseHealthChecker($this->databaseManager);
        
        $response = $databaseChecker->check();
        $this->assertFalse($response->isSuccess());
    }
    
    /**
     * Test success check.
     */
    public function testCheckSuccess(): void
    {
        $this->databaseManager->shouldReceive('reconnect')->andReturn($this->connection);
        $databaseChecker = new DatabaseHealthChecker($this->databaseManager);
        
        $response = $databaseChecker->check();
        $this->assertTrue($response->isSuccess());
    }
}
