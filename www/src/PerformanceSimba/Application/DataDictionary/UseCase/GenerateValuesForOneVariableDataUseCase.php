<?php


namespace App\PerformanceSimba\Application\DataDictionary\UseCase;


use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForOneVariableDataRequest;
use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableData;
use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableDataJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataJoinedRepository;
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
        $this->generateFirstVariableDictionary($request->numberOfVariables());
    }

    private function generateValuesForOneVariableData(int $numberOfVariables): void
    {
        for ($i = 0; $i < $numberOfVariables; $i++) {
            $this->oneVariableDataRepository->save(new OneVariableData($i, rand(0, 1000000) / 100));
        }
    }

    private function generateFirstVariableDictionary(int $numberOfVariables): void
    {
        for ($i = 0; $i < $numberOfVariables; $i++) {
            $firstVariableDictionary = new FirstVariableDictionary($i, "Test name " . $i);
            $this->firstVariableDictionaryRepository->save($firstVariableDictionary);
        }
    }

}