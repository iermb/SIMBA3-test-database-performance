<?php


namespace App\PerformanceSimba\Application\DataDictionary\UseCase;


use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForOneVariableDataJoinedRequest;
use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableDataJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryJoinedRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataJoinedRepository;

class GenerateValuesForOneVariableDataJoinedUseCase
{
    private OneVariableDataJoinedRepository         $oneVariableDataJoinedRepository;
    private FirstVariableDictionaryJoinedRepository $firstVariableDictionaryJoinedRepository;

    public function __construct(
        OneVariableDataJoinedRepository $oneVariableDataJoinedRepository,
        FirstVariableDictionaryJoinedRepository $firstVariableDictionaryJoinedRepository
    ) {
        $this->oneVariableDataJoinedRepository = $oneVariableDataJoinedRepository;
        $this->firstVariableDictionaryJoinedRepository = $firstVariableDictionaryJoinedRepository;
    }

    public function execute(GenerateValuesForOneVariableDataJoinedRequest $request): void
    {
        $this->oneVariableDataJoinedRepository->clean();
        $this->firstVariableDictionaryJoinedRepository->clean();
        for ($i = 0; $i < $request->numberOfVariables(); $i++) {
            $firstVariableDictionaryJoined = new FirstVariableDictionaryJoined($i, "Test name " . $i);
            $this->firstVariableDictionaryJoinedRepository->save($firstVariableDictionaryJoined);
            $this->oneVariableDataJoinedRepository->save(new OneVariableDataJoined($firstVariableDictionaryJoined,
                rand(0, 1000000) / 100));
        }
    }
}