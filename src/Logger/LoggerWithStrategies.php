<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Logger;

use EsgiIw\TpDesignPattern\Logger\Strategy\StrategyInterface;

final class LoggerWithStrategies
{
    /**
     * @var array<StrategyInterface>
     */
    private array $strategies = [];

    public function addStrategy(StrategyInterface $strategy): static
    {
        $this->strategies[] = $strategy;

        return $this;
    }

    public function debug(string $message): void
    {
        $this->logMessage(type: LogTypeEnum::DEBUG, message: $message);
    }

    public function info(string $message): void
    {
        $this->logMessage(type: LogTypeEnum::INFO, message: $message);
    }

    public function warning(string $message): void
    {
        $this->logMessage(type: LogTypeEnum::WARNING, message: $message);
    }

    public function error(string $message): void
    {
        $this->logMessage(type: LogTypeEnum::ERROR, message: $message);
    }

    public function critical(string $message): void
    {
        $this->logMessage(type: LogTypeEnum::CRITICAL, message: $message);
    }

    private function logMessage(LogTypeEnum $type, string $message): void
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->support($type) === false) {
                continue;
            }

            echo "\n* Log sur « " . (new \ReflectionClass($strategy))->getShortName() . " » \n";
            $strategy->logMessage(type: $type, message: $message);
        }
    }
}
