<?php

declare(strict_types=1);

use EsgiIw\TpDesignPattern\Model\Database\DbConnection;

require_once 'vendor/autoload.php';

echo "# Première récupération\n";
$dbConnection = DbConnection::getInstance();
var_dump(spl_object_hash($dbConnection));

echo "\n\n";

echo "# Deuxième récupération\nVérifier qu'il s'agit de la même instance.\n";
$dbConnection2 = DbConnection::getInstance();
var_dump(spl_object_hash($dbConnection2));
var_dump($dbConnection === $dbConnection2);
