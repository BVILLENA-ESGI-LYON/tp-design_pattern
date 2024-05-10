<?php

declare(strict_types=1);

interface EventInterface
{
    public function getDescription(): string;
}

class BasicEvent implements EventInterface
{
    protected string $name;
    protected string $date;
    protected string $location;

    public function __construct(string $name, string $date, string $location)
    {
        $this->name = $name;
        $this->date = $date;
        $this->location = $location;
    }

    public function getDescription(): string
    {
        return "Event: {$this->name}, Date: {$this->date}, Location: {$this->location}";
    }
}

class DescriptionDecorator implements EventInterface
{
    protected EventInterface $event;
    protected string $description;

    public function __construct(EventInterface $event, string $description)
    {
        $this->event = $event;
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->event->getDescription() . ", Description: {$this->description}";
    }
}

class ParticipantsDecorator implements EventInterface
{
    protected EventInterface $event;
    protected int $participants;

    public function __construct(EventInterface $event, int $participants)
    {
        $this->event = $event;
        $this->participants = $participants;
    }

    public function getDescription(): string
    {
        return $this->event->getDescription() . ", Participants: {$this->participants}";
    }
}

class CostDecorator implements EventInterface
{
    protected EventInterface $event;
    protected float $cost;

    public function __construct(EventInterface $event, float $cost)
    {
        $this->event = $event;
        $this->cost = $cost;
    }

    public function getDescription(): string
    {
        return $this->event->getDescription() . ", Cost: {$this->cost}";
    }
}

// Création d'un événement de base
$basicEvent = new BasicEvent('Conference', '2024-05-15', 'New York');

// Ajout décorateurs pour ajouter des fonctionnalités supplémentaires à l'événement de base
$eventWithDescription = new DescriptionDecorator($basicEvent, 'Speed dating.');
$eventWithParticipants = new ParticipantsDecorator($eventWithDescription, 100);
$eventWithCost = new CostDecorator($eventWithParticipants, 10.0);

// Affichage description complète de l'événement avec toutes les fonctionnalités ajoutées
echo $eventWithCost->getDescription();
