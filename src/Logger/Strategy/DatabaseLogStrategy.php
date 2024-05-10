<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Logger\Strategy;

use EsgiIw\TpDesignPattern\Logger\LogTypeEnum;

final class DatabaseLogStrategy implements StrategyInterface
{
    public function logMessage(LogTypeEnum $type, string $message): void
    {
        echo <<<MSG
                Add entry in table "log_messages":\n
                MSG;
        echo <<<SQL
                INSERT INTO log_messages (type, message, occured_at)
                VALUES 
                (
                     '{$this->getDatabaseType($type)}'
                    ,'{$this->getFormatedMessage($message)}'
                    ,'{$this->getDateTime()}'
                )
                SQL;
    }

    public function support(LogTypeEnum $type): bool
    {
        return $type === LogTypeEnum::ERROR || $type === LogTypeEnum::CRITICAL;
    }

    private function getDatabaseType(LogTypeEnum $type): string
    {
        return mb_strtolower($type->name);
    }

    private function getFormatedMessage(string $message): string
    {
        return str_replace(search: '\'', replace: '\'\'', subject: $message);
    }

    private function getDateTime(): string
    {
        return (new \DateTime())->format('Y-m-d H:i:s');
    }
}
