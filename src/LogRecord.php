<?php

declare(strict_types=1);

namespace PHPTrace;

class LogRecord
{
    public string $formattedMessage;

    public function __construct(
        public readonly string $level,
        public readonly string $message,
        public readonly \DateTimeImmutable $timestamp,
        public readonly array $context
    ) {
    }
}