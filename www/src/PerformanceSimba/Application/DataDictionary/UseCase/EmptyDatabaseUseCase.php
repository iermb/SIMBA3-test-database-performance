<?php

namespace App\PerformanceSimba\Application\DataDictionary\UseCase;

use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryJoinedRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\SecondVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\SecondVariableDictionaryJoinedRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThirdVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThirdVariableDictionaryJoinedRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataJoinedRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThreeVariableDataRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThreeVariableDataJoinedRepository;

class EmptyDatabaseUseCase
{
    private OneVariableDataRepository           $oneVariableDataRepository;
    private ThreeVariableDataRepository         $threeVariableDataRepository;
    private FirstVariableDictionaryRepository   $firstVariableDictionaryRepository;
    private SecondVariableDictionaryRepository  $secondVariableDictionaryRepository;
    private ThirdVariableDictionaryRepository   $thirdVariableDictionaryRepository;

    private OneVariableDataJoinedRepository           $oneVariableDataJoinedRepository;
    private ThreeVariableDataJoinedRepository         $threeVariableDataJoinedRepository;
    private FirstVariableDictionaryJoinedRepository   $firstVariableDictionaryJoinedRepository;
    private SecondVariableDictionaryJoinedRepository  $secondVariableDictionaryJoinedRepository;
    private ThirdVariableDictionaryJoinedRepository   $thirdVariableDictionaryJoinedRepository;

    public function __construct(
        OneVariableDataRepository           $oneVariableDataRepository,
        ThreeVariableDataRepository         $threeVariableDataRepository,
        FirstVariableDictionaryRepository   $firstVariableDictionaryRepository,
        SecondVariableDictionaryRepository  $secondVariableDictionaryRepository,
        ThirdVariableDictionaryRepository   $thirdVariableDictionaryRepository,

        OneVariableDataJoinedRepository             $oneVariableDataJoinedRepository,
        ThreeVariableDataJoinedRepository           $threeVariableDataJoinedRepository,
        FirstVariableDictionaryJoinedRepository     $firstVariableDictionaryJoinedRepository,
        SecondVariableDictionaryJoinedRepository    $secondVariableDictionaryJoinedRepository,
        ThirdVariableDictionaryJoinedRepository     $thirdVariableDictionaryJoinedRepository
    ) {
        $this->oneVariableDataRepository =        $oneVariableDataRepository;
        $this->threeVariableDataRepository =        $threeVariableDataRepository;
        $this->firstVariableDictionaryRepository =  $firstVariableDictionaryRepository;
        $this->secondVariableDictionaryRepository = $secondVariableDictionaryRepository;
        $this->thirdVariableDictionaryRepository =  $thirdVariableDictionaryRepository;

        $this->oneVariableDataJoinedRepository =        $oneVariableDataJoinedRepository;
        $this->threeVariableDataJoinedRepository =        $threeVariableDataJoinedRepository;
        $this->firstVariableDictionaryJoinedRepository =  $firstVariableDictionaryJoinedRepository;
        $this->secondVariableDictionaryJoinedRepository = $secondVariableDictionaryJoinedRepository;
        $this->thirdVariableDictionaryJoinedRepository =  $thirdVariableDictionaryJoinedRepository;
    }

    public function execute(): void
    {
        $this->oneVariableDataRepository->clean();
        $this->threeVariableDataRepository->clean();
        $this->firstVariableDictionaryRepository->clean();
        $this->secondVariableDictionaryRepository->clean();
        $this->thirdVariableDictionaryRepository->clean();

        $this->threeVariableDataJoinedRepository->clean();
        $this->oneVariableDataJoinedRepository->clean();
        $this->firstVariableDictionaryJoinedRepository->clean();
        $this->secondVariableDictionaryJoinedRepository->clean();
        $this->thirdVariableDictionaryJoinedRepository->clean();
    }
}