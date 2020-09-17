<?php

namespace Saritasa\LaravelHealthCheck\Contracts;

/**
 * Contract for health checks results.
 */
interface CheckResult
{
    /**
     * Returns health check result.
     *
     * @return boolean
     */
    public function isSuccess(): bool;

    /**
     * Returns error message in case of failure check.
     *
     * @return string|null
     */
    public function getMessage(): ?string;

    /**
     * Returns checks additional payload if it exists.
     *
     * @return array|null
     */
    public function getPayload(): ?array;
}
