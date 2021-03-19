<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\Request\ReadThreeVariableDataByIdRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadThreeVariableDataByIdWithNamesUseCase;
use App\PerformanceSimba\Infrastructure\Service\GenerateRandomIntValues;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EvaluateReadThreeVariableDataByIdController
{
    private ReadThreeVariableDataByIdWithNamesUseCase $readThreeVariableDataByIdWithNamesUseCase;

    public function __construct(ReadThreeVariableDataByIdWithNamesUseCase $readAllOneVariableDataWithNamesUseCase)
    {
        $this->readThreeVariableDataByIdWithNamesUseCase = $readAllOneVariableDataWithNamesUseCase;
    }

    private static function generateRandomNumbersInterval(int $min, int $max, $quantity): array
    {
        $numbers = range($min, $max);
        shuffle($numbers);

        $output = [];

        for ($i = 0; $i < $quantity && count($numbers); $i++) {
            $output[] = array_pop($numbers);
        }

        return $output;
    }

    public function execute(
        int $numberOfAttempts,
        int $numberOfRegisters1,
        int $idMinimum1,
        int $idMaximum1,
        int $numberOfRegisters2,
        int $idMinimum2,
        int $idMaximum2,
        int $numberOfRegisters3,
        int $idMinimum3,
        int $idMaximum3
    ): Response {
        $output = [];

        $generatorIds1 = new GenerateRandomIntValues($idMinimum1, $idMaximum1, $numberOfRegisters1);
        $generatorIds2 = new GenerateRandomIntValues($idMinimum2, $idMaximum2, $numberOfRegisters2);
        $generatorIds3 = new GenerateRandomIntValues($idMinimum3, $idMaximum3, $numberOfRegisters3);

        for ($i = 0; $i < $numberOfAttempts; $i++) {
            $output[] = $this->executeUseCase($i, $generatorIds1, $generatorIds2, $generatorIds3);
        }

        return new JsonResponse($output, Response::HTTP_OK);
        /*
        return new JsonResponse(array_map(
            array($this, "executeUseCase"),
            range(0, $numberOfAttempts),
            $idMinimum,
            $idMaximum,
            $numberOfRegisters
        ), Response::HTTP_OK);
        */
    }

    private function executeUseCase(
        int $nAttempt,
        GenerateRandomIntValues $generatorIds1,
        GenerateRandomIntValues $generatorIds2,
        GenerateRandomIntValues $generatorIds3
    ): array {
        $readThreeVariableDataByIdRequest = new ReadThreeVariableDataByIdRequest($generatorIds1->getRandomValues(),
            $generatorIds2->getRandomValues(),
            $generatorIds3->getRandomValues());

        $startTime = microtime(true);
        $this->readThreeVariableDataByIdWithNamesUseCase->execute($readThreeVariableDataByIdRequest);
        $endTime = microtime(true);

        return [
            "attempt" => $nAttempt,
            "time" => ($endTime - $startTime)
        ];
    }
}