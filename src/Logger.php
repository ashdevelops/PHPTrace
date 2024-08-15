<?php

declare(strict_types=1);

namespace PHPTrace;

use DateTimeImmutable;
use PHPTrace\Handlers\HandlerInterface;
use Psr\Log\AbstractLogger;
use Stringable;

class Logger extends AbstractLogger
{
    private array $handlers;

    public function __construct() {
    }

    public function addHandler(HandlerInterface $handler): void
    {
        $this->handlers[] = $handler;
    }

    public function log($level, Stringable|string $message, array $context = []): void
    {
        $record = new LogRecord(
            $level,
            $message,
            new DateTimeImmutable(),
            $context
        );

        foreach ($this->handlers as $h) {
            $h->emit($record);
        }
    }
}