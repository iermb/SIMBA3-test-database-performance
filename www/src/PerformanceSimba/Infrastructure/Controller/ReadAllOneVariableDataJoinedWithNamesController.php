<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadAllOneVariableDataJoinedWithNamesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReadAllOneVariableDataJoinedWithNamesController
{
    private ReadAllOneVariableDataJoinedWithNamesUseCase $readAllOneVariableDataJoinedWithNamesUseCase;

    public function __construct(
        ReadAllOneVariableDataJoinedWithNamesUseCase $readAllOneVriableDataJoinedWithNamesUseCase
    ) {
        $this->readAllOneVariableDataJoinedWithNamesUseCase = $readAllOneVriableDataJoinedWithNamesUseCase;
    }

    public function execute(): Response
    {
        $response = $this->readAllOneVariableDataJoinedWithNamesUseCase->execute();
        return new JsonResponse($response->allOneVariableDataJoinedWithNamesAsArray(), Response::HTTP_OK);
    }

}