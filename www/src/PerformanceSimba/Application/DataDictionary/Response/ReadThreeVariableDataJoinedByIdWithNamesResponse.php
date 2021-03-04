<?php


namespace App\PerformanceSimba\Application\DataDictionary\Response;


use App\PerformanceSimba\Application\DataDictionary\Service\arrayUtility;
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

    private array $uniqueFirstVariableDictionary = [];
    private array $uniqueSecondVariableDictionary = [];
    private array $uniqueThirdVariableDictionary = [];

    public function __construct(array $listThreeVariableDataJoined)
    {
        $this->listThreeVariableDataJoined = $listThreeVariableDataJoined;
    }

    public function threeVariableDataJoinedByIdWithNamesAsArray(): array
    {

        return [
            self::VARIABLE_NAME_FIELD_1 => arrayUtility::getUniqueArray(array_map(
                array($this, "firstVariableDictionaryAsArray"),
                $this->listThreeVariableDataJoined)
            ),
            self::VARIABLE_NAME_FIELD_2 => arrayUtility::getUniqueArray(array_map(
                array($this, "secondVariableDictionaryAsArray"),
                $this->listThreeVariableDataJoined)
            ),
            self::VARIABLE_NAME_FIELD_3 => arrayUtility::getUniqueArray(array_map(
                array($this, "thirdVariableDictionaryAsArray"),
                $this->listThreeVariableDataJoined)
            ),
            self::VALUES_DATA_FIELD => array_map(
                array($this, "threeVariableDataAsArray"),
                $this->listThreeVariableDataJoined
            )
        ];
    }

    private function firstVariableDictionaryAsArray(ThreeVariableDataJoined $threeVariableDataJoined): array
    {
        return [
            self::ID_VARIABLE_FIELD_1 => $threeVariableDataJoined->firstVariableDictionaryJoined()->id(),
            self::NAME_VARIABLE_FIELD => $threeVariableDataJoined->firstVariableDictionaryJoined()->name()
        ];
    }

    private function secondVariableDictionaryAsArray(ThreeVariableDataJoined $threeVariableDataJoined): array
    {
        return [
            self::ID_VARIABLE_FIELD_2 => $threeVariableDataJoined->secondVariableDictionaryJoined()->id(),
            self::NAME_VARIABLE_FIELD => $threeVariableDataJoined->secondVariableDictionaryJoined()->name()
        ];
    }

    private function thirdVariableDictionaryAsArray(ThreeVariableDataJoined $threeVariableDataJoined): array
    {
        return [
            self::ID_VARIABLE_FIELD_3 => $threeVariableDataJoined->thirdVariableDictionaryJoined()->id(),
            self::NAME_VARIABLE_FIELD => $threeVariableDataJoined->thirdVariableDictionaryJoined()->name()
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