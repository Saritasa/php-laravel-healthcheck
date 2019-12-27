<?php

namespace Saritasa\LaravelHealthCheck\Http;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Saritasa\LaravelHealthCheck\Contracts\CheckResultContract;
use Saritasa\LaravelHealthCheck\HealthCheckManager;
use Illuminate\Routing\Controller;

class HealthCheckApiController extends Controller
{
    /**
     * Health checkers manager.
     *
     * @var HealthCheckManager
     */
    protected $healthCheckManager;

    /**
     * HealthCheckApiController constructor.
     *
     * @param HealthCheckManager $healthCheckManager Health checkers manager.
     */
    public function __construct(HealthCheckManager $healthCheckManager)
    {
        $this->healthCheckManager = $healthCheckManager;
    }

    /**
     * Returns application health check information.
     *
     * @return JsonResponse
     *
     * @throws BindingResolutionException
     */
    public function index(): JsonResponse
    {
        $checksResults = $this->healthCheckManager
            ->checkAll()
            ->mapWithKeys(function (CheckResultContract $healthCheckResult) {
                return [$healthCheckResult->getType() => $healthCheckResult->isSuccess()];
            });

        return new JsonResponse($checksResults);
    }
}