<?php


namespace App\PerformanceSimba\Application\DataDictionary\Request;


class GenerateValuesForThreeVariableDataRequest
{
    private int $numberOfVariables;
    private int $offsetVariable;

    public function __construct(int $offsetVariable, int $numberOfVariables)
    {
        $this->offsetVariable = $offsetVariable;
        $this->numberOfVariables = $numberOfVariables;
    }

    public function numberOfVariables(): int
    {
        return $this->numberOfVariables;
    }

    public function offsetVariable(): int
    {
        return $this->offsetVariable;
    }

}