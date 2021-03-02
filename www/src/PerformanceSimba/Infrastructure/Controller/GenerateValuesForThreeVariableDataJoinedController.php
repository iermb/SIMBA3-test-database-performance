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

    public function execute(
        int $offsetVariable1,
        int $numberOfVariables1,
        int $offsetVariable2,
        int $numberOfVariables2,
        int $offsetVariable3,
        int $numberOfVariables3
    ): Response
    {
        $this->generateValuesForThreeVariableDataJoinedUseCase->execute(
            new GenerateValuesForThreeVariableDataJoinedRequest(
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