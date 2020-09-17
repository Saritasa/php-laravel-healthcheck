<?php

namespace Saritasa\LaravelHealthCheck\Http;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Saritasa\LaravelHealthCheck\Exceptions\CheckerNotFoundException;
use Saritasa\LaravelHealthCheck\Exceptions\InvalidCheckerException;
use Saritasa\LaravelHealthCheck\HealthChecker;

class HealthCheckApiController extends Controller
{
    /**
     * Returns application health check information.
     *
     * @return JsonResponse
     *
     * @param HealthChecker $healthChecks Health checkers manager.
     *
     * @throws BindingResolutionException
     */
    public function index(HealthChecker $healthChecks): JsonResponse
    {
        $results = [];
        $failed = 0;
        foreach ($healthChecks->checkAll() as $name => $result) {
            $results[$name] = $result->isSuccess();
            if (!$result->isSuccess()) {
                $failed++;
            }
        }

        $statusCode = !$failed ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR;
        return new JsonResponse($results, $statusCode);
    }

    /**
     * Run single health check by name
     *
     * @param string $checker
     * @param HealthChecker $healthChecks Health checkers manager.
     *
     * @throws CheckerNotFoundException
     * @throws InvalidCheckerException
     *
     * @return JsonResponse
     */
    public function check(string $checker, HealthChecker $healthChecks): JsonResponse
    {
        $result = $healthChecks->check($checker);
        return new JsonResponse($result->getPayload(), $result->isSuccess()
            ? Response::HTTP_OK
            : Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
