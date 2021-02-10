<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForOneVariableDataJoinedRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\GenerateValuesForOneVariableDataJoinedUseCase;
use Symfony\Component\HttpFoundation\Response;

class GenerateValuesForOneVariableDataJoinedController
{
    private GenerateValuesForOneVariableDataJoinedUseCase $generateValuesForOneVariableDataJoinedUseCase;

    public function __construct(
        GenerateValuesForOneVariableDataJoinedUseCase $generateValuesForOneVariableDataJoinedUseCase
    ) {
        $this->generateValuesForOneVariableDataJoinedUseCase = $generateValuesForOneVariableDataJoinedUseCase;
    }


    public function execute(int $numberOfVariables): Response
    {
        $this->generateValuesForOneVariableDataJoinedUseCase->execute(new GenerateValuesForOneVariableDataJoinedRequest($numberOfVariables));
        return new Response("Data saved", Response::HTTP_OK);
    }
}