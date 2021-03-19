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

    public function execute(
        int $offsetVariable1,
        int $numberOfVariables1,
        int $offsetVariable2,
        int $numberOfVariables2,
        int $offsetVariable3,
        int $numberOfVariables3
    ): Response
    {
        $this->generateValuesForThreeVariableDataUseCase->execute(
            new GenerateValuesForThreeVariableDataRequest(
                $offsetVariable1,
                $numberOfVariables1,
                $offsetVariable2,
                $numberOfVariables2,
                $offsetVariable3,
                $numberOfVariables3
            )
        );
        return new Response("Data saved", Response::HTTP_OK);
    }
}