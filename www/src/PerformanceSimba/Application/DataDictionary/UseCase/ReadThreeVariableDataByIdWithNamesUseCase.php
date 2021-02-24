<?php


namespace App\PerformanceSimba\Application\DataDictionary\UseCase;


use App\PerformanceSimba\Application\DataDictionary\Request\ReadThreeVariableDataByIdRequest;
use App\PerformanceSimba\Application\DataDictionary\Response\ReadThreeVariableDataByIdWithNamesResponse;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\SecondVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThirdVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThreeVariableDataRepository;

class ReadThreeVariableDataByIdWithNamesUseCase
{
    private ThreeVariableDataRepository $threeVariableDataRepository;
    private FirstVariableDictionaryRepository $firstVariableDictionaryRepository;
    private SecondVariableDictionaryRepository $secondVariableDictionaryRepository;
    private ThirdVariableDictionaryRepository $thirdVariableDictionaryRepository;

    public function __construct(
        ThreeVariableDataRepository $threeVariableDataRepository,
        FirstVariableDictionaryRepository $firstVariableDictionaryRepository,
        SecondVariableDictionaryRepository $secondVariableDictionaryRepository,
        ThirdVariableDictionaryRepository $thirdVariableDictionaryRepository
    ) {
        $this->threeVariableDataRepository = $threeVariableDataRepository;
        $this->firstVariableDictionaryRepository = $firstVariableDictionaryRepository;
        $this->secondVariableDictionaryRepository = $secondVariableDictionaryRepository;
        $this->thirdVariableDictionaryRepository = $thirdVariableDictionaryRepository;
    }

    public function execute(ReadThreeVariableDataByIdRequest $request): ReadThreeVariableDataByIdWithNamesResponse
    {
        $this->threeVariableDataRepository->setIds1($request->getIds1());
        $this->threeVariableDataRepository->setIds2($request->getIds2());
        $this->threeVariableDataRepository->setIds3($request->getIds3());

        return new ReadThreeVariableDataByIdWithNamesResponse(
            $this->threeVariableDataRepository->threeVariableDataByIds(),
            $this->firstVariableDictionaryRepository->firstVariableDictionaryByIds($request->getIds1()),
            $this->secondVariableDictionaryRepository->secondVariableDictionaryByIds($request->getIds2()),
            $this->thirdVariableDictionaryRepository->thirdVariableDictionaryByIds($request->getIds3())
        );
    }
}