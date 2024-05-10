<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Adapter\Entity\Event\Export;

final readonly class EventJsonExportAdapter extends AbstractEventExportAdapter implements EventExportAdapterInterface
{
    public function convert(): string
    {
        $jsonStructure = [
            'users' => [],
        ];
        foreach ($this->events as $event) {
            $jsonStructure['users'][] = [
                'id' => $event->getId(),
                'name' => $event->getLabel(),
                'date' => $event->getDate()->format('Y-m-d'),
                'time' => $event->getDate()->format('H:i'),
                'short_description' => mb_strlen($event->getDescription()) > 20
                    ? (substr($event->getDescription(), offset:0, length: 17) . '...')
                    : substr($event->getDescription(), offset: 0, length: 20),
            ];
        }

        return json_encode(
            value: $jsonStructure,
            flags: JSON_THROW_ON_ERROR
        );
    }
}
