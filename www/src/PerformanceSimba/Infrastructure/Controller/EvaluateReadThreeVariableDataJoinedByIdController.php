<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\Request\ReadThreeVariableDataJoinedByIdRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadThreeVariableDataJoinedByIdWithNamesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EvaluateReadThreeVariableDataJoinedByIdController
{
    private ReadThreeVariableDataJoinedByIdWithNamesUseCase $readThreeVariableDataJoinedByIdWithNamesUseCase;

    public function __construct(ReadThreeVariableDataJoinedByIdWithNamesUseCase $readAllOneVariableDataJoinedWithNamesUseCase)
    {
        $this->readThreeVariableDataJoinedByIdWithNamesUseCase = $readAllOneVariableDataJoinedWithNamesUseCase;
    }

    public function execute(int $numberOfAttempts, int $numberOfRegisters, int $idMinimum, int $idMaximum): Response
    {
        $output = [];

        for($i=0; $i<$numberOfAttempts; $i++) {
            $searchedIds = self::generateRandomNumbersInterval($idMinimum, $idMaximum, $numberOfRegisters);
            $output[] = $this->executeUseCase($i, $searchedIds);
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

    private function executeUseCase(int $nAttempt, array $searchedIds): array
    {

        $idsRequest = [
            'ids_1' => $searchedIds,
            'ids_2' => $searchedIds,
            'ids_3' => $searchedIds,
        ];

        $readThreeVariableDataJoinedByIdRequest = new ReadThreeVariableDataJoinedByIdRequest($idsRequest);

        $startTime = microtime(true);
        $this->readThreeVariableDataJoinedByIdWithNamesUseCase->execute($readThreeVariableDataJoinedByIdRequest);
        $endTime = microtime(true);

        return [
            "attempt" => $nAttempt,
            "time" => ($endTime - $startTime)
        ];
    }
}