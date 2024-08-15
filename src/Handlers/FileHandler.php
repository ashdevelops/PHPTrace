<?php

declare(strict_types=1);

namespace PHPTrace\Handlers;

use Exception;
use PHPTrace\Formatters\DefaultFormatter;
use PHPTrace\Formatters\FormatterInterface;
use PHPTrace\Formatters\ProcessorInterface;
use PHPTrace\LogRecord;

readonly class FileHandler implements HandlerInterface
{
    private FormatterInterface $formatter;
    public array $processors;

    /**
     * @throws Exception
     */
    public function __construct(private string $file) {
        if (!file_exists($file)) {
            throw new Exception(sprintf('Unable to find specified log file %s', $file));
        }

        $this->formatter = (new DefaultFormatter());
        $this->processors = [];
    }

    public function addProcessor(ProcessorInterface $processor): void
    {
        $this->processors[] = $processor;
    }

    public function setFormatter(FormatterInterface $formatter): void
    {
        $this->formatter = $formatter;
    }

    private function processRecord(LogRecord $record): LogRecord
    {
        foreach ($this->processors as $processor) {
            $record = $processor($record);
        }

        return $record;
    }

    public function handle(LogRecord $record): void
    {
        $this->formatter->format($record);

        if (count($this->processors) > 0) {
            $record = $this->processRecord($record);
        }

        file_put_contents(
            $this->file,
            $record->formattedMessage . PHP_EOL, FILE_APPEND | LOCK_EX
        );
    }
}