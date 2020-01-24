<?php

namespace Saritasa\LaravelHealthCheck\Tests;

use Exception;
use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Storage;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Saritasa\LaravelHealthCheck\Checkers\DatabaseHealthChecker;
use Saritasa\LaravelHealthCheck\Checkers\S3HealthChecker;

class S3CheckerTest extends TestCase
{
    /**
     * S3 client mock.
     *
     * @var MockInterface|Storage
     */
    protected $S3Client;
    
    /**
     * Setup tests setting.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->S3Client = Storage::partialMock();
    }
    
    /**
     * Test check when database unavailable.
     */
    public function testCheckFail(): void
    {
        $this->S3Client->shouldReceive('cloud');
        $this->S3Client->shouldReceive('directories')->andThrow(new Exception());
        $s3HealthChecker = new S3HealthChecker();
        
        $response = $s3HealthChecker->check();
        $this->assertFalse($response->isSuccess());
    }
    
    /**
     * Test success check.
     */
    public function testCheckSuccess(): void
    {
        $this->S3Client->shouldReceive('cloud');
        $this->S3Client->shouldReceive('directories')->andReturn([]);
        $s3HealthChecker = new S3HealthChecker();
        
        $response = $s3HealthChecker->check();
        $this->assertTrue($response->isSuccess());
    }
}