<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Logger\Strategy;

use EsgiIw\TpDesignPattern\Logger\LogTypeEnum;

final class SendAdminEmailLogStrategy implements StrategyInterface
{
    public function logMessage(LogTypeEnum $type, string $message): void
    {
        echo "Send email to {$this->getAdminEmail()}\n";
        echo <<<MSG
                Subject : Une erreur critique est survenue
                Body : {$message}
                MSG;
    }

    public function support(LogTypeEnum $type): bool
    {
        return $type === LogTypeEnum::CRITICAL;
    }

    private function getAdminEmail(): string
    {
        return 'admin.bde@esgi.fr';
    }
}
