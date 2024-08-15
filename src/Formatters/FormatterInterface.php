<?php

declare(strict_types=1);

namespace PHPTrace\Formatters;

use PHPTrace\LogRecord;

interface FormatterInterface
{
    public function format(LogRecord $record) : void;
}