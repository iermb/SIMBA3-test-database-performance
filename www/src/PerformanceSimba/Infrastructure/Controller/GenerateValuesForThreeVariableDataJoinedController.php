<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForThreeVariableDataJoinedRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\GenerateValuesForThreeVariableDataJoinedUseCase;
use Symfony\Component\HttpFoundation\Response;

class GenerateValuesForThreeVariableDataJoinedController
{
    private GenerateValuesForThreeVariableDataJoinedUseCase $generateValuesForThreeVariableDataJoinedUseCase;

    public function __construct(
        GenerateValuesForThreeVariableDataJoinedUseCase $generateValuesForThreeVariableDataJoinedUseCase
    ) {
        $this->generateValuesForThreeVariableDataJoinedUseCase = $generateValuesForThreeVariableDataJoinedUseCase;
    }

    public function execute(int $offsetVariable, int $numberOfVariables): Response
    {
        $this->generateValuesForThreeVariableDataJoinedUseCase->execute(
            new GenerateValuesForThreeVariableDataJoinedRequest($offsetVariable, $numberOfVariables)
        );
        return new Response("Data saved", Response::HTTP_OK);
    }
}