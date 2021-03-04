<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\Request\ReadThreeVariableDataByIdRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadThreeVariableDataByIdWithNamesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EvaluateReadThreeVariableDataByIdController
{
    private ReadThreeVariableDataByIdWithNamesUseCase $readThreeVariableDataByIdWithNamesUseCase;

    public function __construct(ReadThreeVariableDataByIdWithNamesUseCase $readAllOneVariableDataWithNamesUseCase)
    {
        $this->readThreeVariableDataByIdWithNamesUseCase = $readAllOneVariableDataWithNamesUseCase;
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
    ): Response
    {
        $output = [];

        for($i=0; $i<$numberOfAttempts; $i++) {
            $searchedIds1 = self::generateRandomNumbersInterval($idMinimum1, $idMaximum1, $numberOfRegisters1);
            $searchedIds2 = self::generateRandomNumbersInterval($idMinimum2, $idMaximum2, $numberOfRegisters2);
            $searchedIds3 = self::generateRandomNumbersInterval($idMinimum3, $idMaximum3, $numberOfRegisters3);
            $output[] = $this->executeUseCase($i, $searchedIds1, $searchedIds2, $searchedIds3);
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

    private static function generateRandomNumbersInterval(int $min, int $max, $quantity): array
    {
        $numbers = range($min, $max);
        shuffle($numbers);

        $output = [];

        for($i = 0; $i<$quantity && count($numbers); $i++){
            $output[] = array_pop($numbers);
        }

        return $output;
    }

    private function executeUseCase(int $nAttempt, array $searchedIds1, array $searchedIds2, array $searchedIds3): array
    {

        $startTime = microtime(true);

        $readThreeVariableDataByIdRequest = new ReadThreeVariableDataByIdRequest($searchedIds1, $searchedIds2, $searchedIds3);
        $this->readThreeVariableDataByIdWithNamesUseCase->execute($readThreeVariableDataByIdRequest);

        $endTime = microtime(true);

        return [
            "attempt" => $nAttempt,
            "time" => ($endTime - $startTime)
        ];
    }
}