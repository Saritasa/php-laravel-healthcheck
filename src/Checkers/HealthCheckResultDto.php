<?php

namespace Saritasa\LaravelHealthCheck\Checkers;

use Saritasa\Dto;
use Saritasa\LaravelHealthCheck\Contracts\CheckResultContract;

class HealthCheckResultDto extends Dto implements CheckResultContract
{
    public const IS_SUCCESS = 'isSuccess';
    public const TYPE = 'type';
    public const MESSAGE = 'message';
    public const PAYLOAD = 'payload';

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
    public function getType(): string
    {
        return $this->type;
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
