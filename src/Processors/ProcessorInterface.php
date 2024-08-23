<?php

declare(strict_types=1);

namespace PHPTrace\Processors;

use PHPTrace\LogRecord;

interface ProcessorInterface
{
    public function process(LogRecord $record) : void;
}