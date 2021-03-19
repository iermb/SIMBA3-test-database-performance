<?php

namespace App\PerformanceSimba\Application\DataDictionary\UseCase;

use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForThreeVariableDataRequest;
use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\SecondVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\ThirdVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\ThreeVariableData;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\SecondVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThirdVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThreeVariableDataRepository;

class GenerateValuesForThreeVariableDataUseCase
{
    private ThreeVariableDataRepository         $threeVariableDataRepository;
    private FirstVariableDictionaryRepository   $firstVariableDictionaryRepository;
    private SecondVariableDictionaryRepository  $secondVariableDictionaryRepository;
    private ThirdVariableDictionaryRepository   $thirdVariableDictionaryRepository;

    public function __construct(
        ThreeVariableDataRepository         $threeVariableDataRepository,
        FirstVariableDictionaryRepository   $firstVariableDictionaryRepository,
        SecondVariableDictionaryRepository  $secondVariableDictionaryRepository,
        ThirdVariableDictionaryRepository   $thirdVariableDictionaryRepository
    ) {
        $this->threeVariableDataRepository =        $threeVariableDataRepository;
        $this->firstVariableDictionaryRepository =  $firstVariableDictionaryRepository;
        $this->secondVariableDictionaryRepository = $secondVariableDictionaryRepository;
        $this->thirdVariableDictionaryRepository =  $thirdVariableDictionaryRepository;
    }

    public function execute(GenerateValuesForThreeVariableDataRequest $request): void
    {
        $startNumberVar1 = $request->offsetVariable1();
        $endNumberVar1 = $startNumberVar1 + $request->numberOfVariables1() - 1;

        $startNumberVar2 = $request->offsetVariable2();
        $endNumberVar2 = $startNumberVar2 + $request->numberOfVariables2() - 1;

        $startNumberVar3 = $request->offsetVariable3();
        $endNumberVar3 = $startNumberVar3 + $request->numberOfVariables3() - 1;

        $this->generateValuesForThreeVariableData(
            $startNumberVar1,
            $endNumberVar1,
            $startNumberVar2,
            $endNumberVar2,
            $startNumberVar3,
            $endNumberVar3
        );

        $this->generateVariableDictionaries($startNumberVar1, $endNumberVar1, $this->firstVariableDictionaryRepository, FirstVariableDictionary::class);
        $this->generateVariableDictionaries($startNumberVar2, $endNumberVar2, $this->secondVariableDictionaryRepository, SecondVariableDictionary::class);
        $this->generateVariableDictionaries($startNumberVar3, $endNumberVar3, $this->thirdVariableDictionaryRepository, ThirdVariableDictionary::class);
    }

    private function generateValuesForThreeVariableData(
        int $startNumberVar1,
        int $endNumberVar1,
        int $startNumberVar2,
        int $endNumberVar2,
        int $startNumberVar3,
        int $endNumberVar3
    ): void
    {
        $listThreeVariableData = [];

        for ($var1 = $startNumberVar1; $var1 <= $endNumberVar1; $var1++) {
            for ($var2 = $startNumberVar2; $var2 <= $endNumberVar2; $var2++) {
                for ($var3 = $startNumberVar3; $var3 <= $endNumberVar3; $var3++) {
                    $listThreeVariableData[] = new ThreeVariableData($var1, $var2, $var3, rand(0, 1000000) / 100);
                }
            }
        }
        $this->threeVariableDataRepository->saveMultiple($listThreeVariableData);
    }

    private function generateVariableDictionaries(int $startNumber, int $endNumber, object $repository, string $object): void
    {
        $arrayDictionaries = [];

        for($i = $startNumber; $i <= $endNumber; $i++) {
            $arrayDictionaries[] = new $object($i, "Test name " . $i);
        }

        $repository->saveMultiple($arrayDictionaries);
    }
}