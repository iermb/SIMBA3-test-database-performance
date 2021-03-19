<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Entity;


class ThreeVariableDataJoined
{
    private FirstVariableDictionaryJoined   $firstVariableDictionaryJoined;
    private SecondVariableDictionaryJoined  $secondVariableDictionaryJoined;
    private ThirdVariableDictionaryJoined   $thirdVariableDictionaryJoined;
    private float                           $value;

    public function __construct(
        FirstVariableDictionaryJoined $firstVariableDictionaryJoined,
        SecondVariableDictionaryJoined $secondVariableDictionaryJoined,
        ThirdVariableDictionaryJoined $thirdVariableDictionaryJoined,
        float $value
    ) {
        $this->firstVariableDictionaryJoined = $firstVariableDictionaryJoined;
        $this->secondVariableDictionaryJoined = $secondVariableDictionaryJoined;
        $this->thirdVariableDictionaryJoined = $thirdVariableDictionaryJoined;
        $this->value = $value;
    }

    public function firstVariableDictionaryJoined(): FirstVariableDictionaryJoined
    {
        return $this->firstVariableDictionaryJoined;
    }

    public function secondVariableDictionaryJoined(): SecondVariableDictionaryJoined
    {
        return $this->secondVariableDictionaryJoined;
    }

    public function thirdVariableDictionaryJoined(): ThirdVariableDictionaryJoined
    {
        return $this->thirdVariableDictionaryJoined;
    }

    public function value(): float
    {
        return $this->value;
    }

}