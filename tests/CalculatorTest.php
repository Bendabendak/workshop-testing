<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use IW\Workshop\Calculator;

final class CalculatorTest extends TestCase
{
    private Calculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculator();
    }

    public function testAdd(): void
    {
        $this->assertSame(5.0, $this->calculator->add(2.0, 3.0));
        $this->assertSame(0.0, $this->calculator->add(-1.5, 1.5));
        $this->assertSame(-7.0, $this->calculator->add(-3.0, -4.0));
    }

    public function testDivide(): void
    {
        $this->assertSame(2.0, $this->calculator->divide(6.0, 3.0));
        $this->assertSame(-2.5, $this->calculator->divide(-5.0, 2.0));
    }

    public function testDivideByZeroThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Division by zero');

        $this->calculator->divide(10.0, 0.0);
    }
}
