<?php

declare(strict_types=1);

interface LoginAlertInterface
{
    public function sendAlert(string $username): void;
}

class FileLogAlert implements LoginAlertInterface
{
    public function sendAlert(string $username): void
    {
        $logMessage = "l'utilisateur : $username s'est connecté à " . date('Y-m-d H:i:s') . PHP_EOL;
        file_put_contents('login.log', $logMessage, FILE_APPEND);
    }
}

class DatabaseAlert implements LoginAlertInterface
{
    public function sendAlert(string $username): void
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=my_database', 'username', 'password');
        $statement = $pdo->prepare("INSERT INTO login_alerts (username, timestamp) VALUES (:username, :timestamp)");
        $statement->execute(['username' => $username, 'timestamp' => date('Y-m-d H:i:s')]);
    }
}

class EmailAlert implements LoginAlertInterface
{
    public function sendAlert(string $username): void
    {
        $adminEmail = 'admin@admin.com';
        $subject = 'Login Alert';
        $message = "l'Utilisateur : $username s'est connecté à " . date('Y-m-d H:i:s');
        mail($adminEmail, $subject, $message);
    }
}

interface LoginAlertFactory
{
    public function createAlert(): LoginAlertInterface;
}

class FileLogAlertFactory implements LoginAlertFactory
{
    public function createAlert(): LoginAlertInterface
    {
        return new FileLogAlert();
    }
}

class DatabaseAlertFactory implements LoginAlertFactory
{
    public function createAlert(): LoginAlertInterface
    {
        return new DatabaseAlert();
    }
}

class EmailAlertFactory implements LoginAlertFactory
{
    public function createAlert(): LoginAlertInterface
    {
        return new EmailAlert();
    }
}

// Utilisation de la Factory Method pour créer différents types de supports d'alerte
$fileLogAlertFactory = new FileLogAlertFactory();
$fileLogAlert = $fileLogAlertFactory->createAlert();
$fileLogAlert->sendAlert('john_doe');

$databaseAlertFactory = new DatabaseAlertFactory();
$databaseAlert = $databaseAlertFactory->createAlert();
$databaseAlert->sendAlert('emilia_clark');

$emailAlertFactory = new EmailAlertFactory();
$emailAlert = $emailAlertFactory->createAlert();
$emailAlert->sendAlert('admin');
