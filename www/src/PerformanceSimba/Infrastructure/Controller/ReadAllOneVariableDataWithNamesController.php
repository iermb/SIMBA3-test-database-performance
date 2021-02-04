<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadAllOneVariableDataWithNamesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReadAllOneVariableDataWithNamesController
{
    private ReadAllOneVariableDataWithNamesUseCase $readAllOneVariableDataWithNamesUseCase;

    public function __construct(ReadAllOneVariableDataWithNamesUseCase $readAllOneVariableDataWithNamesUseCase)
    {
        $this->readAllOneVariableDataWithNamesUseCase = $readAllOneVariableDataWithNamesUseCase;
    }

    public function execute(): Response
    {
        $response = $this->readAllOneVariableDataWithNamesUseCase->execute();
        return new JsonResponse($response->allOneVariableDataWithNamesAsArray(), Response::HTTP_OK);
    }

}