<?php


namespace App\PerformanceSimba\Application\DataDictionary\Response;


use App\PerformanceSimba\Domain\DataDictionary\Entity\ThreeVariableDataJoined;

class ReadThreeVariableDataJoinedByIdWithNamesResponse
{
    private const VARIABLE_NAME_FIELD_1  = "firstVariableNames";
    private const VARIABLE_NAME_FIELD_2  = "secondVariableNames";
    private const VARIABLE_NAME_FIELD_3  = "thirdVariableNames";
    private const VALUES_DATA_FIELD    = "values";
    private const ID_VARIABLE_FIELD_1    = "var1_id";
    private const ID_VARIABLE_FIELD_2    = "var2_id";
    private const ID_VARIABLE_FIELD_3    = "var3_id";
    private const NAME_VARIABLE_FIELD  = "name";

    private array $listThreeVariableDataJoined;

    public function __construct(array $listThreeVariableDataJoined)
    {
        $this->listThreeVariableDataJoined = $listThreeVariableDataJoined;
    }

    public function threeVariableDataJoinedByIdWithNamesAsArray(): array
    {
        return [
            self::VARIABLE_NAME_FIELD_1 => array_map(
                array($this, "firstVariableDictionaryAsArray"),
                $this->listThreeVariableDataJoined
            ),
            self::VARIABLE_NAME_FIELD_2 => array_map(
                array($this, "secondVariableDictionaryAsArray"),
                $this->listThreeVariableDataJoined
            ),
            self::VARIABLE_NAME_FIELD_3 => array_map(
                array($this, "thirdVariableDictionaryAsArray"),
                $this->listThreeVariableDataJoined
            ),
            self::VALUES_DATA_FIELD => array_map(
                array($this, "threeVariableDataAsArray"),
                $this->listThreeVariableDataJoined
            )
        ];
    }

    private function firstVariableDictionaryAsArray(ThreeVariableDataJoined $ThreeVariableDataJoined): array
    {
        return [
            self::ID_VARIABLE_FIELD_1 => $ThreeVariableDataJoined->firstVariableDictionaryJoined()->id(),
            self::NAME_VARIABLE_FIELD => $ThreeVariableDataJoined->firstVariableDictionaryJoined()->name()
        ];
    }

    private function secondVariableDictionaryAsArray(ThreeVariableDataJoined $ThreeVariableDataJoined): array
    {
        return [
            self::ID_VARIABLE_FIELD_2 => $ThreeVariableDataJoined->secondVariableDictionaryJoined()->id(),
            self::NAME_VARIABLE_FIELD => $ThreeVariableDataJoined->secondVariableDictionaryJoined()->name()
        ];
    }

    private function thirdVariableDictionaryAsArray(ThreeVariableDataJoined $ThreeVariableDataJoined): array
    {
        return [
            self::ID_VARIABLE_FIELD_3 => $ThreeVariableDataJoined->thirdVariableDictionaryJoined()->id(),
            self::NAME_VARIABLE_FIELD => $ThreeVariableDataJoined->thirdVariableDictionaryJoined()->name()
        ];
    }

    private function threeVariableDataAsArray(ThreeVariableDataJoined $oneVariableDataJoined): array
    {
        return [
            $oneVariableDataJoined->firstVariableDictionaryJoined()->id(),
            $oneVariableDataJoined->secondVariableDictionaryJoined()->id(),
            $oneVariableDataJoined->thirdVariableDictionaryJoined()->id(),
            $oneVariableDataJoined->value()
        ];
    }
}