<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Adapter\Entity\Event\Export;

use EsgiIw\TpDesignPattern\Model\Entity\Event;

final readonly class EventCsvExportAdapter extends AbstractEventExportAdapter implements EventExportAdapterInterface
{
    public function convert(): string
    {
        // Headers
        $fileContent = $this->createLine('ID', 'Libellé', 'Description', 'Date événement');
        foreach ($this->events as $event) {
            $fileContent .= "\n" . $this->createLine(
                    (string) $event->getId(),
                    $event->getLabel(),
                    $event->getDescription(),
                    $event->getDate()->format('d/m/Y H:i')
                );
        }

        return $fileContent;
    }

    private function createLine(string ...$data): string
    {
        return implode(separator: ';', array: $data);
    }
}
