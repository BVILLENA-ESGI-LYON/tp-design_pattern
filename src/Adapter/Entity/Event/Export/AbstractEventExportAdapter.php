<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Adapter\Entity\Event\Export;

use EsgiIw\TpDesignPattern\Model\Entity\Event;

abstract readonly class AbstractEventExportAdapter
{
    public function __construct(
        /**
         * @var array<Event>
         */
        protected array $events,
    ) {
        foreach ($this->events as $event) {
            if ($event instanceof Event) {
                continue;
            }

            throw new \TypeError(
                'Should be of type "' . Event::class . '"; but "' . get_debug_type($event) . '" given.'
            );
        }
    }
}
