<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Logger;

enum LogTypeEnum
{
    case DEBUG;
    case INFO;
    case WARNING;
    case ERROR;
    case CRITICAL;
}
