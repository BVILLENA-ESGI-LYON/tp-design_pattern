<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Model\Database;

final class DbConnection
{
    private static ?DbConnection $instance = null;

    public static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __construct() {
        // Connexion DB
    }

    private function __clone(): void
    {
        // Forbidden!
    }
}
