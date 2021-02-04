<?php


namespace App\PerformanceSimba\Application\DataDictionary\UseCase;


use App\PerformanceSimba\Application\DataDictionary\Response\ReadAllOneVariableDataWithNamesResponse;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataRepository;

class ReadAllOneVariableDataWithNamesUseCase
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

    public function execute(): ReadAllOneVariableDataWithNamesResponse
    {
        return new ReadAllOneVariableDataWithNamesResponse($this->oneVariableDataRepository->allOneVariableData(),
            $this->firstVariableDictionaryRepository->allFirstVariableDictionary());
    }

}