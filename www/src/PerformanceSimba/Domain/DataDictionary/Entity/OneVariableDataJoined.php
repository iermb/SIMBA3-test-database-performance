<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Entity;


class OneVariableDataJoined
{
    private FirstVariableDictionary $firstVariableDictionary;
    private float $value;

    public function __construct(FirstVariableDictionary $firstVariableDictionary, float $value)
    {
        $this->firstVariableDictionary = $firstVariableDictionary;
        $this->value = $value;
    }

    public function firstVariableDictionary(): FirstVariableDictionary
    {
        return $this->firstVariableDictionary;
    }

    public function value(): float
    {
        return $this->value;
    }

}