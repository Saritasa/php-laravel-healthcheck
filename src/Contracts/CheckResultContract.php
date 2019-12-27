<?php

namespace Saritasa\LaravelHealthCheck\Contracts;

/**
 * Contract for health checks results.
 */
interface CheckResultContract
{
    /**
     * Returns health check result.
     *
     * @return bool
     */
    public function isSuccess(): bool;

    /**
     * Returns type of check.
     *
     * @return string
     */
    public function getType(): string;

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
