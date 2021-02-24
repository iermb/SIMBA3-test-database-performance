<?php

namespace App\PerformanceSimba\Domain\DataDictionary\Entity;

class ThreeVariableData
{
    private int $variableFirstId;
    private int $variableSecondId;
    private int $variableThirdId;
    private float $value;

    public function __construct(
        int $variableFirstId,
        int $variableSecondId,
        int $variableThirdId,
        float $value
    ) {
        $this->variableFirstId = $variableFirstId;
        $this->variableSecondId = $variableSecondId;
        $this->variableThirdId = $variableThirdId;
        $this->value = $value;
    }

    public function variableFirstId(): int
    {
        return $this->variableFirstId;
    }

    public function variableSecondId(): int
    {
        return $this->variableSecondId;
    }

    public function variableThirdId(): int
    {
        return $this->variableThirdId;
    }

    public function value(): float
    {
        return $this->value;
    }
}