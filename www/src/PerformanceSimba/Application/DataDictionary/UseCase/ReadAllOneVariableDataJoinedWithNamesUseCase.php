<?php


namespace App\PerformanceSimba\Application\DataDictionary\UseCase;


use App\PerformanceSimba\Application\DataDictionary\Response\ReadAllOneVariableDataJoinedWithNamesResponse;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataJoinedRepository;

class ReadAllOneVariableDataJoinedWithNamesUseCase
{
    private OneVariableDataJoinedRepository $oneVariableDataJoinedRepository;

    public function __construct(OneVariableDataJoinedRepository $oneVariableDataJoinedRepository)
    {
        $this->oneVariableDataJoinedRepository = $oneVariableDataJoinedRepository;
    }

    public function execute(): ReadAllOneVariableDataJoinedWithNamesResponse
    {
        return new ReadAllOneVariableDataJoinedWithNamesResponse($this->oneVariableDataJoinedRepository->allOneVariableDataJoined());
    }
}