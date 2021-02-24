<?php


namespace App\PerformanceSimba\Application\DataDictionary\Response;


use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\SecondVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\ThirdVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\ThreeVariableData;

class ReadThreeVariableDataByIdWithNamesResponse
{
    private const VARIABLE_NAME_FIELD_1  = "firstVariableNames";
    private const VARIABLE_NAME_FIELD_2  = "secondVariableNames";
    private const VARIABLE_NAME_FIELD_3  = "thirdVariableNames";
    private const VALUES_DATA_FIELD    = "values";
    private const ID_VARIABLE_FIELD_1    = "var1_id";
    private const ID_VARIABLE_FIELD_2    = "var2_id";
    private const ID_VARIABLE_FIELD_3    = "var3_id";
    private const NAME_VARIABLE_FIELD  = "name";

    private array $listThreeVariableData;
    private array $listFirstVariableDictionary;
    private array $listSecondVariableDictionary;
    private array $listThirdVariableDictionary;

    public function __construct(
        array $listThreeVariableData,
        array $listFirstVariableDictionary,
        array $listSecondVariableDictionary,
        array $listThirdVariableDictionary
    ) {
        $this->listThreeVariableData = $listThreeVariableData;
        $this->listFirstVariableDictionary = $listFirstVariableDictionary;
        $this->listSecondVariableDictionary = $listSecondVariableDictionary;
        $this->listThirdVariableDictionary = $listThirdVariableDictionary;
    }

    public function threeVariableDataByIdWithNamesAsArray(): array
    {
        return [
            self::VARIABLE_NAME_FIELD_1 => array_map(
                array($this, "firstVariableDictionaryAsArray"),
                $this->listFirstVariableDictionary
            ),
            self::VARIABLE_NAME_FIELD_2 => array_map(
                array($this, "secondVariableDictionaryAsArray"),
                $this->listSecondVariableDictionary
            ),
            self::VARIABLE_NAME_FIELD_3 => array_map(
                array($this, "thirdVariableDictionaryAsArray"),
                $this->listThirdVariableDictionary
            ),
            self::VALUES_DATA_FIELD => array_map(
                array($this, "threeVariableDataAsArray"),
                $this->listThreeVariableData
            )
        ];
    }

    private function firstVariableDictionaryAsArray(FirstVariableDictionary $firstVariableDictionary): array
    {
        return [
            self::ID_VARIABLE_FIELD_1 => $firstVariableDictionary->id(),
            self::NAME_VARIABLE_FIELD => $firstVariableDictionary->name(),
        ];
    }

    private function secondVariableDictionaryAsArray(SecondVariableDictionary $secondVariableDictionary): array
    {
        return [
            self::ID_VARIABLE_FIELD_2 => $secondVariableDictionary->id(),
            self::NAME_VARIABLE_FIELD => $secondVariableDictionary->name(),
        ];
    }

    private function thirdVariableDictionaryAsArray(ThirdVariableDictionary $thirdVariableDictionary): array
    {
        return [
            self::ID_VARIABLE_FIELD_3 => $thirdVariableDictionary->id(),
            self::NAME_VARIABLE_FIELD => $thirdVariableDictionary->name(),
        ];
    }

    private function threeVariableDataAsArray(ThreeVariableData $threeVariableData): array
    {
        return [
            $threeVariableData->variableFirstId(),
            $threeVariableData->variableSecondId(),
            $threeVariableData->variableThirdId(),
            $threeVariableData->value(),
        ];
    }
}