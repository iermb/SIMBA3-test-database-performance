<?php


namespace App\PerformanceSimba\Application\DataDictionary\Response;


use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableData;

class ReadAllOneVariableDataWithNamesResponse
{
    private const VARIABLE_NAME_FIELD  = "firstVariableNames";
    private const VALUES_DATA_FIELD    = "values";
    private const ID_VARIABLE_FIELD    = "var1_id";
    private const VALUE_VARIABLE_FIELD = "value";
    private const NAME_VARIABLE_FIELD  = "name";

    private array $listOneVariableData;
    private array $listFirstVariableDictionary;

    public function __construct(array $listOneVariableData, array $listFirstVariableDictionary)
    {
        $this->listFirstVariableDictionary = $listFirstVariableDictionary;
        $this->listOneVariableData = $listOneVariableData;
    }

    public function allOneVariableDataWithNamesAsArray(): array
    {
        return [
            self::VARIABLE_NAME_FIELD => array_map(array($this, "firstVariableDictionaryAsArray"),
                $this->listFirstVariableDictionary),
            self::VALUES_DATA_FIELD => array_map(array($this, "oneVariableDataAsArray"), $this->listOneVariableData),
        ];
    }

    private function firstVariableDictionaryAsArray(FirstVariableDictionary $firstVariableDictionary): array
    {
        return [
            self::ID_VARIABLE_FIELD => $firstVariableDictionary->id(),
            self::NAME_VARIABLE_FIELD => $firstVariableDictionary->name()
        ];
    }

    private function oneVariableDataAsArray(OneVariableData $oneVariableData): array
    {
        return [
            self::ID_VARIABLE_FIELD => $oneVariableData->variableId(),
            self::VALUE_VARIABLE_FIELD => $oneVariableData->value()
        ];
    }

}