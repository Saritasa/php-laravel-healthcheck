<?php

namespace Saritasa\LaravelHealthCheck\Checkers;

use Saritasa\Dto;
use Saritasa\LaravelHealthCheck\Contracts\CheckResult;

class HealthCheckResultDto extends Dto implements CheckResult
{
    public const IS_SUCCESS = 'isSuccess';
    public const MESSAGE = 'message';
    public const PAYLOAD = 'payload';

    public function __construct(?string $message, bool $success = false, $payload = null)
    {
        parent::__construct([
            static::MESSAGE => $message,
            static::PAYLOAD => $payload,
            static::IS_SUCCESS => $success,
        ]);
    }

    /**
     * Shows whether check was success or not.
     *
     * @var boolean
     */
    protected $isSuccess = false;

    /**
     * Type of check.
     *
     * @var string
     */
    protected $type;

    /**
     * Error message in case of failure.
     *
     * @var string|null
     */
    protected $message = null;

    /**
     * Additional payload of checking.
     *
     * @var array|null
     */
    protected $payload = null;

    /**
     * {@inheritDoc}
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * {@inheritDoc}
     */
    public function getPayload(): ?array
    {
        return $this->payload;
    }
}
