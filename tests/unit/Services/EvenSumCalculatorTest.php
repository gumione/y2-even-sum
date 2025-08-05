<?php
declare(strict_types=1);

namespace tests\unit\Services;

use app\services\EvenSumCalculator;
use PHPUnit\Framework\TestCase;

class EvenSumCalculatorTest extends TestCase
{
    private EvenSumCalculator $calc;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calc = new EvenSumCalculator();
    }

    public function testEmptyArray(): void
    {
        $this->assertSame(0, $this->calc->calculate([]));
    }

    public function testAllOdd(): void
    {
        $this->assertSame(0, $this->calc->calculate([1, 3, 5]));
    }

    public function testMixed(): void
    {
        $this->assertSame(12, $this->calc->calculate([2, 3, 4, 6]));
    }

    public function testNegativeNumbers(): void
    {
        $this->assertSame(-2, $this->calc->calculate([-3, -2, -1, 0, 1]));
    }

    public function testZeros(): void
    {
        $this->assertSame(0, $this->calc->calculate([0, 0, 0]));
    }

    public function testLargeNumbers(): void
    {
        $this->assertSame(3000000000, $this->calc->calculate([1000000000, 2000000000, 999]));
    }
}
