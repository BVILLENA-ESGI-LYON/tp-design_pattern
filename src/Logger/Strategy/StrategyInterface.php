<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Logger\Strategy;

use EsgiIw\TpDesignPattern\Logger\LogTypeEnum;

interface StrategyInterface
{
    public function logMessage(LogTypeEnum $type, string $message): void;

    public function support(LogTypeEnum $type): bool;
}
