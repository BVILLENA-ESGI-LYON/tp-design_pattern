<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Logger\Strategy;

use EsgiIw\TpDesignPattern\Logger\LogTypeEnum;

class FileLogStrategy implements StrategyInterface
{
    public function logMessage(LogTypeEnum $type, string $message): void
    {
        echo <<<MSG
                Add line in file "{$this->getLogFilename()}":
                {$this->getDateTime()} [{$type->name}] {$message}
                MSG;
    }

    public function support(LogTypeEnum $type): bool
    {
        // Let another Strategy handle "debug" log messages
        return $type !== LogTypeEnum::DEBUG;
    }

    protected function getLogFilename(): string
    {
        return sys_get_temp_dir() . '/design-patterns/var/log/app.log';
    }

    protected function getDateTime(): string
    {
        return (new \DateTime())->format('Y-m-d H:i:s');
    }
}
