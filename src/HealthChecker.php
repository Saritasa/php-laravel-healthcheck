<?php

namespace Saritasa\LaravelHealthCheck;

use Exception;
use Illuminate\Support\Collection;
use Saritasa\LaravelHealthCheck\Checkers\HealthCheckResultDto;
use Saritasa\LaravelHealthCheck\Contracts\CheckResult;
use Saritasa\LaravelHealthCheck\Contracts\ServiceHealthChecker;
use Saritasa\LaravelHealthCheck\Exceptions\CheckerNotFoundException;
use Saritasa\LaravelHealthCheck\Exceptions\InvalidCheckerException;

final class HealthChecker
{
    /**
     * Returns health checks of or available service in application.
     *
     * @return Collection|CheckResult[]
     *
     * @throws InvalidCheckerException
     */
    public function checkAll(): Collection
    {
        $results = collect();

        foreach (config('health_check.checkers') as $name => $class) {
            $results->put($name, $this->run($class));
        }

        return $results;
    }

    /**
     * Returns health check of specific service.
     *
     * @param string $type Type of service to health check it
     *
     * @return CheckResult
     *
     * @throws CheckerNotFoundException
     * @throws InvalidCheckerException
     */
    public function check(string $type): CheckResult
    {
        $class = config('health_check.checkers.'.$type);
        if (!$class) {
            throw new CheckerNotFoundException("Check type $type not configured");
        }
        return $this->run($class);
    }

    /**
     * Returns health check of specific service.
     *
     * @param string $class Checker class to run
     *
     * @return CheckResult
     *
     * @throws InvalidCheckerException
     */
    private function run(string $class): CheckResult
    {
        if (!is_subclass_of($class, ServiceHealthChecker::class)) {
            throw new InvalidCheckerException("Class $class is not instance of ".ServiceHealthChecker::class);
        }

        try {
            /** @var ServiceHealthChecker $checker */
            $checker = app($class);
            return $checker->check();
        } catch (Exception $exception) {
            return new HealthCheckResultDto($exception->getMessage());
        }
    }
}
