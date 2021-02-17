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
        $startTime = microtime(1);

        $response = $this->readAllOneVariableDataWithNamesUseCase->execute();

        $duration = microtime(1) - $startTime;

        $result = [
            $response->allOneVariableDataWithNamesAsArray(),
            'duration' => $duration
        ];

        return new JsonResponse($result, Response::HTTP_OK);
    }

}