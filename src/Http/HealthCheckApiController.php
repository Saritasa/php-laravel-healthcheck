<?php

namespace Saritasa\LaravelHealthCheck\Http;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Saritasa\LaravelHealthCheck\Contracts\CheckResult;
use Saritasa\LaravelHealthCheck\HealthChecker;
use Illuminate\Routing\Controller;

class HealthCheckApiController extends Controller
{
    /**
     * Health checkers manager.
     *
     * @var HealthChecker
     */
    protected $healthCheckManager;

    /**
     * HealthCheckApiController constructor.
     *
     * @param HealthChecker $healthCheckManager Health checkers manager.
     */
    public function __construct(HealthChecker $healthCheckManager)
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
            ->mapWithKeys(function (CheckResult $healthCheckResult) {
                return [$healthCheckResult->getType() => $healthCheckResult->isSuccess()];
            });

        $statusCode = $checksResults->count() === $checksResults->filter()->count()
            ? Response::HTTP_OK
            : Response::HTTP_INTERNAL_SERVER_ERROR;

        return new JsonResponse($checksResults, $statusCode);
    }
}
