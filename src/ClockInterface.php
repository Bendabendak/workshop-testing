<?php

declare(strict_types=1);

namespace IW\Workshop;

use DateTimeInterface;

interface ClockInterface
{
    public function now(): DateTimeInterface;
}
