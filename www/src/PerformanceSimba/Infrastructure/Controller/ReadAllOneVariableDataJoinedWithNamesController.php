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
        $startTime = microtime(1);

        $response = $this->readAllOneVariableDataJoinedWithNamesUseCase->execute();

        $duration = microtime(1) - $startTime;

        $result = [
            $response->allOneVariableDataJoinedWithNamesAsArray(),
            'duration' => $duration
        ];

        return new JsonResponse($result, Response::HTTP_OK);
    }

}