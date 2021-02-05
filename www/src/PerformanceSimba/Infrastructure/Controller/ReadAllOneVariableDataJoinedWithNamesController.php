<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\Response\ReadAllOneVariableDataJoinedWithNamesResponse;
use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadAllOneVariableDataJoinedWithNamesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReadAllOneVariableDataJoinedWithNamesController
{
    private ReadAllOneVariableDataJoinedWithNamesUseCase $readAllOneVriableDataJoinedWithNamesUseCase;

    public function __construct(
        ReadAllOneVariableDataJoinedWithNamesUseCase $readAllOneVriableDataJoinedWithNamesUseCase
    ) {
        $this->readAllOneVriableDataJoinedWithNamesUseCase = $readAllOneVriableDataJoinedWithNamesUseCase;
    }

    public function execute(): Response
    {
        $response = $this->readAllOneVriableDataJoinedWithNamesUseCase->execute();
        return new JsonResponse($response->allOneVariableDataWithNamesAsArray(), Response::HTTP_OK);
    }


}