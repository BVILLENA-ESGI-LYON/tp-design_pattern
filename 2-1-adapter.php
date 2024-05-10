<?php

declare(strict_types=1);

use EsgiIw\TpDesignPattern\Adapter\Entity\Event\Export\EventCsvExportAdapter;
use EsgiIw\TpDesignPattern\Adapter\Entity\Event\Export\EventJsonExportAdapter;
use EsgiIw\TpDesignPattern\Model\Entity\Event;

require_once 'vendor/autoload.php';

// Récupération des événements
$eventsToExport = [
    (new Event())
        ->setId(1)
        ->setLabel('Gala du printemps')
        ->setDescription('Assistez à la soirée de gala pour le printemps.')
        ->setDate(new \DateTime('2024-04-26 19:30')),

    (new Event())
        ->setId(2)
        ->setLabel('Soirée League of Legend')
        ->setDescription('Rejoignez vos comparses sur LoL.')
        ->setDate(new \DateTime('2024-04-20 21:00')),

    (new Event())
        ->setId(5)
        ->setLabel('Afterwork de fin avril')
        ->setDescription('Tous au bar pour la fin du mois d\'avril.')
        ->setDate(new \DateTime('2024-04-30 18:00')),
];

// Définition des adapteurs
$adapters = [
    new EventCsvExportAdapter($eventsToExport),
    new EventJsonExportAdapter($eventsToExport),
];

// Utilisation des adapteurs
foreach ($adapters as $adapter) {
    echo '# Adapter ' . $adapter::class . "\n";
    echo $adapter->convert();
    echo "\n\n";
}
