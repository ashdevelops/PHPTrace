<?php

declare(strict_types=1);

namespace PHPTrace\Formatters;

use PHPTrace\LogRecord;

class DefaultFormatter implements FormatterInterface
{
    public function format(LogRecord $record) : void {
        $record->formattedMessage = sprintf(
            '[%s][%s] %s',
            $record->timestamp->format('c'),
            $record->level,
            $record->message
        );
    }
}