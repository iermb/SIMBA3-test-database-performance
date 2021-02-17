<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadAllOneVariableDataJoinedWithNamesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EvaluateReadOneVariableDataJoinedController
{
    private ReadAllOneVariableDataJoinedWithNamesUseCase $readAllOneVariableDataJoinedWithNamesUseCase;

    public function __construct(
        ReadAllOneVariableDataJoinedWithNamesUseCase $readAllOneVariableDataJoinedWithNamesUseCase
    ) {
        $this->readAllOneVariableDataJoinedWithNamesUseCase = $readAllOneVariableDataJoinedWithNamesUseCase;
    }

    public function execute(int $numberOfAttempts): Response
    {
        return new JsonResponse(array_map(array($this, "executeUseCase"), range(0, $numberOfAttempts)),
            Response::HTTP_OK);
    }

    private function executeUseCase(int $nAttempt): array
    {
        $startTime = microtime(true);
        $this->readAllOneVariableDataJoinedWithNamesUseCase->execute();
        $endTime = microtime(true);

        return [
            "attempt" => $nAttempt,
            "time" => ($endTime - $startTime)
        ];
    }
}