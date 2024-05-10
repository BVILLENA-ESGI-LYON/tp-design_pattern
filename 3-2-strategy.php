<?php

declare(strict_types=1);

use EsgiIw\TpDesignPattern\Logger\LoggerWithStrategies;
use EsgiIw\TpDesignPattern\Logger\Strategy\FileLogStrategy;
use EsgiIw\TpDesignPattern\Logger\Strategy\FileDebugLogStrategy;
use EsgiIw\TpDesignPattern\Logger\Strategy\DatabaseLogStrategy;
use EsgiIw\TpDesignPattern\Logger\Strategy\SendAdminEmailLogStrategy;

require_once 'vendor/autoload.php';

// Mise en place du service de log avec ses stratégies
$logger = new LoggerWithStrategies();
$logger
    ->addStrategy(new FileLogStrategy())
    ->addStrategy(new FileDebugLogStrategy())
    ->addStrategy(new DatabaseLogStrategy())
    ->addStrategy(new SendAdminEmailLogStrategy());

echo "# Log d'un message de debug\n";
echo '> Doit être enregistré dans le fichier "debug.log" seulement.';
echo "\n";

$logger->debug('J\'utilise des stratégies !');

echo "\n\n";
echo '------------------------------';
echo "\n\n";

echo "# Log d'un message de warning\n";
echo '> Doit être enregistré dans le fichier de log classique.';
echo "\n";

$logger->warning('La solution de "logger" n\'est pas entièrement implémentée.');

echo "\n\n";
echo '------------------------------';
echo "\n\n";

echo "# Log d'un message d'erreur\n";
echo '> Doit être enregistré dans le fichier de log classique et en BDD.';
echo "\n";

$logger->error('L\'extension "pdo" est manquante.');

echo "\n\n";
echo '------------------------------';
echo "\n\n";

echo "# Log d'un message d'erreur critique\n";
echo '> Doit être enregistré dans le fichier de log classique, en BDD et notifié par mail à l\'administrateur.';
echo "\n";

$logger->critical('Les secrets de l\'application sont écrits en dur !');
