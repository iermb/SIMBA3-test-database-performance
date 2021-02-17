<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadAllOneVariableDataWithNamesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EvaluateReadOneVariableDataController
{
    private ReadAllOneVariableDataWithNamesUseCase $readAllOneVariableDataWithNamesUseCase;

    public function __construct(ReadAllOneVariableDataWithNamesUseCase $readAllOneVariableDataWithNamesUseCase)
    {
        $this->readAllOneVariableDataWithNamesUseCase = $readAllOneVariableDataWithNamesUseCase;
    }

    public function execute(int $numberOfAttempts): Response
    {
        return new JsonResponse(array_map(array($this, "executeUseCase"), range(0, $numberOfAttempts)), Response::HTTP_OK);
    }

    private function executeUseCase(int $nAttempt): array
    {
        $startTime = microtime(true);
        $this->readAllOneVariableDataWithNamesUseCase->execute();
        $endTime = microtime(true);

        return [
            "attempt" => $nAttempt,
            "time" => ($endTime - $startTime)
        ];
    }
}