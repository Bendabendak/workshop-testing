<?php

declare(strict_types=1);

namespace IW\Workshop;

class DateFormatter
{
    private ClockInterface $clock;

    public function __construct(ClockInterface $clock)
    {
        $this->clock = $clock;
    }

    public function getPartOfDay(): string
    {
        $dateTime = $this->clock->now();
        $currentHour = (int) $dateTime->format('G');

        if ($currentHour >= 0 && $currentHour < 6) {
            return 'Night';
        }

        if ($currentHour >= 6 && $currentHour < 12) {
            return 'Morning';
        }

        if ($currentHour >= 12 && $currentHour < 18) {
            return 'Afternoon';
        }

        return 'Evening';
    }
}
