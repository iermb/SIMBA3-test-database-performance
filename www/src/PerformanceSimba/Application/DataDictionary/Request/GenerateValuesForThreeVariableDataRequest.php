<?php


namespace App\PerformanceSimba\Application\DataDictionary\Request;


class GenerateValuesForThreeVariableDataRequest
{
    private int $numberOfVariables1;
    private int $offsetVariable1;
    private int $numberOfVariables2;
    private int $offsetVariable2;
    private int $numberOfVariables3;
    private int $offsetVariable3;

    public function __construct(
        int $offsetVariable1,
        int $numberOfVariables1,
        int $offsetVariable2,
        int $numberOfVariables2,
        int $offsetVariable3,
        int $numberOfVariables3
    ) {
        $this->offsetVariable1 = $offsetVariable1;
        $this->numberOfVariables1 = $numberOfVariables1;
        $this->offsetVariable2 = $offsetVariable2;
        $this->numberOfVariables2 = $numberOfVariables2;
        $this->offsetVariable3 = $offsetVariable3;
        $this->numberOfVariables3 = $numberOfVariables3;
    }

    public function numberOfVariables1(): int
    {
        return $this->numberOfVariables1;
    }

    public function offsetVariable1(): int
    {
        return $this->offsetVariable1;
    }
    public function numberOfVariables2(): int
    {
        return $this->numberOfVariables2;
    }

    public function offsetVariable2(): int
    {
        return $this->offsetVariable2;
    }

    public function numberOfVariables3(): int
    {
        return $this->numberOfVariables3;
    }

    public function offsetVariable3(): int
    {
        return $this->offsetVariable3;
    }

}