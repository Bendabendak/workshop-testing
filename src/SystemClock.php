<?php

declare(strict_types=1);

namespace IW\Workshop;

use DateTimeImmutable;
use DateTimeInterface;

class SystemClock implements ClockInterface
{
    public function now(): DateTimeInterface
    {
        return new DateTimeImmutable();
    }
}
