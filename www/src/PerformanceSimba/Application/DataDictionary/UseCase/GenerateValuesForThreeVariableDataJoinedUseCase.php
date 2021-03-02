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

        $startNumberVar1 = $request->offsetVariable1();
        $endNumberVar1 = $startNumberVar1 + $request->numberOfVariables1() - 1;

        $startNumberVar2 = $request->offsetVariable2();
        $endNumberVar2 = $startNumberVar2 + $request->numberOfVariables2() - 1;

        $startNumberVar3 = $request->offsetVariable3();
        $endNumberVar3 = $startNumberVar3 + $request->numberOfVariables3() - 1;

        $arrayVar1 = $this->createListVariableDictionary($startNumberVar1, $endNumberVar1, FirstVariableDictionaryJoined::class);
        $arrayVar2 = $this->createListVariableDictionary($startNumberVar2, $endNumberVar2, SecondVariableDictionaryJoined::class);
        $arrayVar3 = $this->createListVariableDictionary($startNumberVar3, $endNumberVar3, ThirdVariableDictionaryJoined::class);

        $arrayThreeVariable = [];

        foreach ($arrayVar1 as $var1) {
            foreach ($arrayVar2 as $var2) {
                foreach ($arrayVar3 as $var3) {
                    $arrayThreeVariable[] = new ThreeVariableDataJoined($var1, $var2, $var3,rand(0, 1000000) / 100);
                }
            }
        }

        $this->threeVariableDataJoinedRepository->saveMultiple($arrayThreeVariable);
    }

    private function createListVariableDictionary(int $startNumberVar, int $endNumberVar, string $typeVarDictionary): array {
        return array_map(
            function($id) use ($typeVarDictionary) {
                return new $typeVarDictionary($id, "Test name " . $id);
            },
            range($startNumberVar, $endNumberVar)
        );
    }
}