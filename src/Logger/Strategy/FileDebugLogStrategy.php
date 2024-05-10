<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Logger\Strategy;

use EsgiIw\TpDesignPattern\Logger\LogTypeEnum;

final class FileDebugLogStrategy extends FileLogStrategy implements StrategyInterface
{
    public function support(LogTypeEnum $type): bool
    {
        return $type === LogTypeEnum::DEBUG;
    }

    protected function getLogFilename(): string
    {
        return sys_get_temp_dir() . '/design-patterns/var/log/debug.log';
    }
}
