<?php


namespace App\PerformanceSimba\Application\DataDictionary\UseCase;


use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForOneVariableDataRequest;
use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableData;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataRepository;

class GenerateValuesForOneVariableDataUseCase
{
    private OneVariableDataRepository         $oneVariableDataRepository;
    private FirstVariableDictionaryRepository $firstVariableDictionaryRepository;

    public function __construct(
        OneVariableDataRepository $oneVariableDataRepository,
        FirstVariableDictionaryRepository $firstVariableDictionaryRepository
    ) {
        $this->oneVariableDataRepository = $oneVariableDataRepository;
        $this->firstVariableDictionaryRepository = $firstVariableDictionaryRepository;
    }

    public function execute(GenerateValuesForOneVariableDataRequest $request): void
    {
        $this->oneVariableDataRepository->clean();
        $this->firstVariableDictionaryRepository->clean();
        $this->generateValuesForOneVariableData($request->numberOfVariables());
        $this->generateFirstVariableDictionaries($request->numberOfVariables());
    }

    private function generateValuesForOneVariableData(int $numberOfVariables): void
    {
        $this->oneVariableDataRepository->saveMultiple(array_map(array($this, "generateOneVariableData"),
            range(0, $numberOfVariables)));
    }

    private function generateFirstVariableDictionaries(int $numberOfVariables): void
    {
        $this->firstVariableDictionaryRepository->saveMultiple(array_map(array($this, "generateFirstVariableDictionary"),
            range(0, $numberOfVariables)));
    }

    private function generateFirstVariableDictionary(int $id): FirstVariableDictionary
    {
        return new FirstVariableDictionary($id, "Test name " . $id);
    }

    private function generateOneVariableData(int $id): OneVariableData
    {
        return new OneVariableData($id, rand(0, 1000000) / 100);
    }

}