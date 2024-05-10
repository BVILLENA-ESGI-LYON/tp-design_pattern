<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Adapter\Entity\Event\Export;

interface EventExportAdapterInterface
{
    public function convert(): string;
}
