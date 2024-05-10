<?php

declare(strict_types=1);

interface AlertContentInterface
{
    public function getContent(): string;
}

class EmailAlertContent implements AlertContentInterface
{
    public function getContent(): string
    {
        // Format contenu d'alerte e-mail
        return "Ceci est un SMS d'alerte !";
    }
}

class SmsAlertContent implements AlertContentInterface
{
    public function getContent(): string
    {
        // Format contenu d'alerte SMS
        return "Ceci est un SMS d'alerte !";
    }
}

interface AlertContentFactory
{
    public function createContent(): AlertContentInterface;
}

class EmailAlertContentFactory implements AlertContentFactory
{
    public function createContent(): AlertContentInterface
    {
        return new EmailAlertContent();
    }
}

class SmsAlertContentFactory implements AlertContentFactory
{
    public function createContent(): AlertContentInterface
    {
        return new SmsAlertContent();
    }
}

// Utilisation de l'Abstract Factory pour créer le contenu d'alerte
$emailAlertContentFactory = new EmailAlertContentFactory();
$emailAlertContent = $emailAlertContentFactory->createContent();
echo "Email : " . $emailAlertContent->getContent() . PHP_EOL;

$smsAlertContentFactory = new SmsAlertContentFactory();
$smsAlertContent = $smsAlertContentFactory->createContent();
echo "SMS : " . $smsAlertContent->getContent() . PHP_EOL;
