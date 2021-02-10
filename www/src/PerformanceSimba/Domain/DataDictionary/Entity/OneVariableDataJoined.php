<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Entity;


class OneVariableDataJoined
{
    private FirstVariableDictionaryJoined $firstVariableDictionaryJoined;
    private float                         $value;

    public function __construct(FirstVariableDictionaryJoined $firstVariableDictionaryJoined, float $value)
    {
        $this->firstVariableDictionaryJoined = $firstVariableDictionaryJoined;
        $this->value = $value;
    }

    public function firstVariableDictionaryJoined(): FirstVariableDictionaryJoined
    {
        return $this->firstVariableDictionaryJoined;
    }

    public function value(): float
    {
        return $this->value;
    }

}