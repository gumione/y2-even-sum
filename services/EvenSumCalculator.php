<?php
declare(strict_types=1);

namespace app\services;

use app\services\interfaces\SumCalculatorInterface;

class EvenSumCalculator implements SumCalculatorInterface
{
    public function calculate(array $numbers): int
    {
        return array_sum(
            array_filter($numbers, fn(int $n): bool => $n % 2 === 0)
        );
    }
}
