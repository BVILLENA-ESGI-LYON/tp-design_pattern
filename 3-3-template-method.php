<?php

declare(strict_types=1);

abstract class EventRegistration
{
    public function validateRegistration(): void
    {
        $this->checkEligibility();
        $this->specificValidation();
        $this->notifyUser();
    }

}

class SportsEventRegistration extends EventRegistration
{
    protected function specificValidation(): void
    {
        echo "Un événement sportif nécessite un certificat médical." . PHP_EOL;
    }
}

class BDEEventRegistration extends EventRegistration
{
    protected function specificValidation(): void
    {
        echo "Places réservées pour les membres du BDE." . PHP_EOL;
    }
}

//Utilisation
$sportsEventRegistration = new SportsEventRegistration();
$sportsEventRegistration->validateRegistration();

$bdeEventRegistration = new BDEEventRegistration();
$bdeEventRegistration->validateRegistration();
