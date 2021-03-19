<?php


namespace App\PerformanceSimba\Infrastructure\Service;


class GenerateRandomIntValues
{
    private int $minValue;
    private int $maxValue;
    private int $numberOfValues;

    public function __construct(int $minValue, int $maxValue, int $numberOfValues)
    {
        $this->minValue = $minValue;
        $this->maxValue = $maxValue;
        $this->numberOfValues = $numberOfValues;
    }

    public function getRandomValues(): array
    {
        $arrayValues = range($this->minValue, $this->maxValue);
        shuffle($arrayValues);
        return array_slice($arrayValues, 0, $this->numberOfValues);
    }
}