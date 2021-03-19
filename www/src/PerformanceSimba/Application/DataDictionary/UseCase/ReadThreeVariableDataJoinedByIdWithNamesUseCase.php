<?php


namespace App\PerformanceSimba\Application\DataDictionary\UseCase;


use App\PerformanceSimba\Application\DataDictionary\Request\ReadThreeVariableDataJoinedByIdRequest;
use App\PerformanceSimba\Application\DataDictionary\Response\ReadThreeVariableDataJoinedByIdWithNamesResponse;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThreeVariableDataJoinedRepository;

class ReadThreeVariableDataJoinedByIdWithNamesUseCase
{
    private ThreeVariableDataJoinedRepository $threeVariableDataJoinedRepository;

    public function __construct(ThreeVariableDataJoinedRepository $threeVariableDataJoinedRepository)
    {
        $this->threeVariableDataJoinedRepository = $threeVariableDataJoinedRepository;
    }

    public function execute(ReadThreeVariableDataJoinedByIdRequest $request): ReadThreeVariableDataJoinedByIdWithNamesResponse
    {
        $this->threeVariableDataJoinedRepository->setIds1($request->getIds1());
        $this->threeVariableDataJoinedRepository->setIds2($request->getIds2());
        $this->threeVariableDataJoinedRepository->setIds3($request->getIds3());

        return new ReadThreeVariableDataJoinedByIdWithNamesResponse(
            $this->threeVariableDataJoinedRepository->threeVariableDataJoinedByIds()
        );
    }
}