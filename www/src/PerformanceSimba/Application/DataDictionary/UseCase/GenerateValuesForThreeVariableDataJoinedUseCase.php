<?php


namespace App\PerformanceSimba\Application\DataDictionary\UseCase;


use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForThreeVariableDataJoinedRequest;
use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Entity\SecondVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Entity\ThirdVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Entity\ThreeVariableDataJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryJoinedRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\SecondVariableDictionaryJoinedRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThirdVariableDictionaryJoinedRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThreeVariableDataJoinedRepository;

class GenerateValuesForThreeVariableDataJoinedUseCase
{
    private ThreeVariableDataJoinedRepository           $threeVariableDataJoinedRepository;
    private FirstVariableDictionaryJoinedRepository     $firstVariableDictionaryJoinedRepository;
    private SecondVariableDictionaryJoinedRepository    $secondVariableDictionaryJoinedRepository;
    private ThirdVariableDictionaryJoinedRepository     $thirdVariableDictionaryJoinedRepository;

    public function __construct(
        ThreeVariableDataJoinedRepository           $threeVariableDataJoinedRepository,
        FirstVariableDictionaryJoinedRepository     $firstVariableDictionaryJoinedRepository,
        SecondVariableDictionaryJoinedRepository    $secondVariableDictionaryJoinedRepository,
        ThirdVariableDictionaryJoinedRepository     $thirdVariableDictionaryJoinedRepository
    ) {
        $this->threeVariableDataJoinedRepository =          $threeVariableDataJoinedRepository;
        $this->firstVariableDictionaryJoinedRepository =    $firstVariableDictionaryJoinedRepository;
        $this->secondVariableDictionaryJoinedRepository =   $secondVariableDictionaryJoinedRepository;
        $this->thirdVariableDictionaryJoinedRepository =    $thirdVariableDictionaryJoinedRepository;
    }

    public function execute(GenerateValuesForThreeVariableDataJoinedRequest $request): void
    {
        //$this->threeVariableDataJoinedRepository->clean();
        //$this->firstVariableDictionaryJoinedRepository->clean();
        //$this->secondVariableDictionaryJoinedRepository->clean();
        //$this->thirdVariableDictionaryJoinedRepository->clean();

        $startNumberVar = $request->offsetVariable();
        $endNumberVar = $startNumberVar + $request->numberOfVariables() - 1;

        $arrayFirstVariableDictionaryJoined = array_map(array($this, "generateFirstVariableDictionaryJoined"),
            range($startNumberVar, $endNumberVar));

        $arraySecondVariableDictionaryJoined = array_map(array($this, "generateSecondVariableDictionaryJoined"),
            range($startNumberVar, $endNumberVar));

        $arrayThirdVariableDictionaryJoined = array_map(array($this, "generateThirdVariableDictionaryJoined"),
            range($startNumberVar, $endNumberVar));

        $this->threeVariableDataJoinedRepository->saveMultiple(
            array_map(
                array($this, "generateThreeVariableDataJoined"),
                $arrayFirstVariableDictionaryJoined,
                $arraySecondVariableDictionaryJoined,
                $arrayThirdVariableDictionaryJoined,
            )
        );
    }

    private function generateFirstVariableDictionaryJoined(int $id): FirstVariableDictionaryJoined
    {
        return new FirstVariableDictionaryJoined($id, "Test name 1st var " . $id);
    }

    private function generateSecondVariableDictionaryJoined(int $id): SecondVariableDictionaryJoined
    {
        return new SecondVariableDictionaryJoined($id, "Test name 2nd var " . $id);
    }

    private function generateThirdVariableDictionaryJoined(int $id): ThirdVariableDictionaryJoined
    {
        return new ThirdVariableDictionaryJoined($id, "Test name 3rd var " . $id);
    }

    private function generateThreeVariableDataJoined(
        FirstVariableDictionaryJoined $firstVariableDictionaryJoined,
        SecondVariableDictionaryJoined $secondVariableDictionaryJoined,
        ThirdVariableDictionaryJoined $thirdVariableDictionaryJoined
    ): ThreeVariableDataJoined {
        return new ThreeVariableDataJoined(
            $firstVariableDictionaryJoined,
            $secondVariableDictionaryJoined,
            $thirdVariableDictionaryJoined,
            rand(0, 1000000) / 100);
    }
}