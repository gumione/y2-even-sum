<?php
declare(strict_types=1);

namespace app\services\interfaces;

interface SumCalculatorInterface
{
    /**
     * Calculates the sum of the even number from an array
     *
     * @param int[] $numbers
     * @return int
     */
    public function calculate(array $numbers): int;
}
