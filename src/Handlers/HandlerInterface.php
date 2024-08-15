<?php

declare(strict_types=1);

namespace PHPTrace\Handlers;

use PHPTrace\LogRecord;

interface HandlerInterface
{
    public function handle(LogRecord $record) : void;
}