<?php

declare(strict_types=1);

interface EventObserverInterface
{
    public function update(Event $event): void;
}

class Event
{
    private string $name;
    private string $date;
    private string $location;
    private array $observers = [];

    public function __construct(string $name, string $date, string $location)
    {
        $this->name = $name;
        $this->date = $date;
        $this->location = $location;
    }

    public function addObserver(EventObserverInterface $observer): void
    {
        $this->observers[] = $observer;
    }

    public function removeObserver(EventObserverInterface $observer): void
    {
        $key = array_search($observer, $this->observers, true);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->notifyObservers();
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
        $this->notifyObservers();
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
        $this->notifyObservers();
    }

    public function notifyObservers(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    // Getters
    public function getName(): string
    {
        return $this->name;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getLocation(): string
    {
        return $this->location;
    }
}

class EventLoggingObserver implements EventObserverInterface
{
    public function update(Event $event): void
    {
        echo "Event updated: {$event->getName()}, {$event->getDate()}, {$event->getLocation()}" . PHP_EOL;
    }
}

// Création événement
$event = new Event('Conference', '2024-05-15', 'New York');

// Ajout  observateur pour enregistrer les modifications d'événements
$eventLogger = new EventLoggingObserver();
$event->addObserver($eventLogger);

// Modifications de l'événement
$event->setName('Workshop');
$event->setDate('2024-06-20');
$event->setLocation('London');
