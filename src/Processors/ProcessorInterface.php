<?php

declare(strict_types=1);

namespace PHPTrace\Formatters;

use PHPTrace\LogRecord;

interface ProcessorInterface
{
    public function process(LogRecord $record) : void;
}