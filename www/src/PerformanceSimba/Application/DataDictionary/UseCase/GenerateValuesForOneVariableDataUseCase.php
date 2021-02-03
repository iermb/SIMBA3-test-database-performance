<?php


namespace App\PerformanceSimba\Application\DataDictionary\UseCase;


use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForOneVariableDataRequest;
use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableData;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataRepository;

class GenerateValuesForOneVariableDataUseCase
{
    private OneVariableDataRepository $oneVariableDataRepository;

    public function __construct(OneVariableDataRepository $oneVariableDataRepository)
    {
        $this->oneVariableDataRepository = $oneVariableDataRepository;
    }

    public function execute(GenerateValuesForOneVariableDataRequest $request): void
    {
        for ($i = 0; $i < $request->numberOfVariables(); $i++) {
            $this->oneVariableDataRepository->save(new OneVariableData($i, rand() / 100));
        }
    }

}