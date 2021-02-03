<?php

namespace App\PerformanceSimba\Domain\DataDictionary\Entity;

class OneVariableData
{
    private int $variableId;
    private float $value;

    public function __construct(int $variableId, float $value)
    {
        $this->variableId = $variableId;
        $this->value = $value;
    }

    public function variableId(): int
    {
        return $this->variableId;
    }

    public function value(): float
    {
        return $this->value;
    }
}