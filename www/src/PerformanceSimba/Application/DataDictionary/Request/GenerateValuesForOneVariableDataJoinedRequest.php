<?php


namespace App\PerformanceSimba\Application\DataDictionary\Request;


class GenerateValuesForOneVariableDataJoinedRequest
{
    private int $numberOfVariables;

    public function __construct(int $numberOfVariables)
    {
        $this->numberOfVariables = $numberOfVariables;
    }

    public function numberOfVariables(): int
    {
        return $this->numberOfVariables;
    }

}