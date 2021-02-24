<?php

namespace App\PerformanceSimba\Application\DataDictionary\UseCase;

use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForThreeVariableDataRequest;
use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\SecondVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\ThirdVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\ThreeVariableData;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\SecondVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThirdVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThreeVariableDataRepository;

class GenerateValuesForThreeVariableDataUseCase
{
    private ThreeVariableDataRepository         $threeVariableDataRepository;
    private FirstVariableDictionaryRepository   $firstVariableDictionaryRepository;
    private SecondVariableDictionaryRepository  $secondVariableDictionaryRepository;
    private ThirdVariableDictionaryRepository   $thirdVariableDictionaryRepository;

    public function __construct(
        ThreeVariableDataRepository         $threeVariableDataRepository,
        FirstVariableDictionaryRepository   $firstVariableDictionaryRepository,
        SecondVariableDictionaryRepository  $secondVariableDictionaryRepository,
        ThirdVariableDictionaryRepository   $thirdVariableDictionaryRepository
    ) {
        $this->threeVariableDataRepository =        $threeVariableDataRepository;
        $this->firstVariableDictionaryRepository =  $firstVariableDictionaryRepository;
        $this->secondVariableDictionaryRepository = $secondVariableDictionaryRepository;
        $this->thirdVariableDictionaryRepository =  $thirdVariableDictionaryRepository;
    }

    public function execute(GenerateValuesForThreeVariableDataRequest $request): void
    {
        $startNumberVar = $request->offsetVariable();
        $endNumberVar = $startNumberVar + $request->numberOfVariables() - 1;

        $this->generateValuesForThreeVariableData($startNumberVar, $endNumberVar);
        $this->generateFirstSecondThirdVariableDictionaries($startNumberVar, $endNumberVar);
    }

    private function generateValuesForThreeVariableData(int $startNumberVar, int $endNumberVar): void
    {
        $this->threeVariableDataRepository->saveMultiple(array_map(array($this, "generateThreeVariableData"),
            range($startNumberVar, $endNumberVar)));
    }

    private function generateFirstSecondThirdVariableDictionaries(int $startNumberVar, int $endNumberVar): void
    {
        $this->firstVariableDictionaryRepository->saveMultiple(array_map(
            array($this, "generateFirstVariableDictionary"),
            range($startNumberVar, $endNumberVar)
        ));

        $this->secondVariableDictionaryRepository->saveMultiple(array_map(
            array($this, "generateSecondVariableDictionary"),
            range($startNumberVar, $endNumberVar)
        ));

        $this->thirdVariableDictionaryRepository->saveMultiple(array_map(
            array($this, "generateThirdVariableDictionary"),
            range($startNumberVar, $endNumberVar)
        ));
    }

    private function generateFirstVariableDictionary(int $id): FirstVariableDictionary
    {
        return new FirstVariableDictionary($id, "Test name " . $id);
    }

    private function generateSecondVariableDictionary(int $id): SecondVariableDictionary
    {
        return new SecondVariableDictionary($id, "Test name " . $id);
    }

    private function generateThirdVariableDictionary(int $id): ThirdVariableDictionary
    {
        return new ThirdVariableDictionary($id, "Test name " . $id);
    }

    private function generateThreeVariableData(int $id): ThreeVariableData
    {
        return new ThreeVariableData($id, $id, $id, rand(0, 1000000) / 100);
    }

}