<?php

namespace Saritasa\LaravelHealthCheck\Tests;

use Exception;
use Illuminate\Support\Facades\Cache;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Predis\ClientInterface;
use Saritasa\LaravelHealthCheck\Checkers\RedisHealthChecker;

class RedisCheckerTest extends TestCase
{
    /**
     * Redis mock.
     *
     * @var MockInterface
     */
    protected $redis;
    
    /**
     * @var Mockery\LegacyMockInterface|MockInterface|ClientInterface
     */
    protected $client;
    
    /**
     * Setup tests setting.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->redis = Cache::partialMock();
        $this->client = Mockery::mock(ClientInterface::class);
        $this->redis->shouldReceive('connection')->andReturn($this->client);
    }
    
    /**
     *
     */
    public function testCheckSuccess(): void
    {
        $this->client->shouldReceive('ping')->andReturn(null);
        $databaseChecker = new RedisHealthChecker();
        
        $response = $databaseChecker->check();
        $this->assertTrue($response->isSuccess());
    }
    
    /**
     * Test check when redis unavailable.
     */
    public function testCheckFail(): void
    {
        $this->client->shouldReceive('ping')->andThrow(new Exception());
        $databaseChecker = new RedisHealthChecker();

        $response = $databaseChecker->check();
        $this->assertFalse($response->isSuccess());
    }
   
    
}