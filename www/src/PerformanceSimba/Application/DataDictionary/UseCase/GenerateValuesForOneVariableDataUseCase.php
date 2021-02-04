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
        $this->generateValuesForOneVariableData($request->numberOfVariables());
        $this->generateFirstVariableDictionary($request->numberOfVariables());
    }

    private function generateValuesForOneVariableData(int $numberOfVariables): void
    {
        $this->oneVariableDataRepository->clean();
        for ($i = 0; $i < $numberOfVariables; $i++) {
            $this->oneVariableDataRepository->save(new OneVariableData($i, rand() / 100));
        }
    }

    private function generateFirstVariableDictionary(int $numberOfVariables): void
    {
        $this->firstVariableDictionaryRepository->clean();
        for ($i = 0; $i < $numberOfVariables; $i++) {
            $this->firstVariableDictionaryRepository->save(new FirstVariableDictionary($i, "Test name " . $i));
        }
    }

}