<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForThreeVariableDataRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\GenerateValuesForThreeVariableDataUseCase;
use Symfony\Component\HttpFoundation\Response;

class GenerateValuesForThreeVariableDataController
{
    private GenerateValuesForThreeVariableDataUseCase $generateValuesForThreeVariableDataUseCase;

    public function __construct(
        GenerateValuesForThreeVariableDataUseCase $generateValuesForThreeVariableDataUseCase
    ) {
        $this->generateValuesForThreeVariableDataUseCase = $generateValuesForThreeVariableDataUseCase;
    }

    public function execute(int $offsetVariable, int $numberOfVariables): Response
    {
        $this->generateValuesForThreeVariableDataUseCase->execute(
            new GenerateValuesForThreeVariableDataRequest($offsetVariable, $numberOfVariables)
        );
        return new Response("Data saved", Response::HTTP_OK);
    }
}