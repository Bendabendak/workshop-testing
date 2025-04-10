<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use IW\Workshop\DateFormatter;
use IW\Workshop\ClockInterface;

final class DateFormatterTest extends TestCase
{
    private function getMockClockWithHour(int $hour): ClockInterface
    {
        $mock = $this->createMock(ClockInterface::class);
        $mock->method('now')->willReturn(
            DateTimeImmutable::createFromFormat(
                format: 'H',
                datetime: (string) $hour
            )
        );
        return $mock;
    }

    public function testNight(): void
    {
        $formatter = new DateFormatter($this->getMockClockWithHour(hour: 2));
        $this->assertSame('Night', $formatter->getPartOfDay());
    }

    public function testMorning(): void
    {
        $formatter = new DateFormatter($this->getMockClockWithHour(hour: 9));
        $this->assertSame('Morning', $formatter->getPartOfDay());
    }

    public function testAfternoon(): void
    {
        $formatter = new DateFormatter($this->getMockClockWithHour(hour: 14));
        $this->assertSame('Afternoon', $formatter->getPartOfDay());
    }

    public function testEvening(): void
    {
        $formatter = new DateFormatter($this->getMockClockWithHour(hour: 21));
        $this->assertSame('Evening', $formatter->getPartOfDay());
    }
}
