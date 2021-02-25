<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\Request\ReadThreeVariableDataByIdRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadThreeVariableDataByIdWithNamesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReadThreeVariableDataByIdWithNamesController
{
    private ReadThreeVariableDataByIdWithNamesUseCase $readThreeVariableDataByIdWithNamesUseCase;

    public function __construct(
        ReadThreeVariableDataByIdWithNamesUseCase $readThreeVariableDataByIdWithNamesUseCase
    ) {
        $this->readThreeVariableDataByIdWithNamesUseCase = $readThreeVariableDataByIdWithNamesUseCase;
    }

    public function execute(string $jsonRequest): Response
    {
        $dataRequest = json_decode($jsonRequest, true);

        $startTime = microtime(1);

        $response = $this->readThreeVariableDataByIdWithNamesUseCase->execute(
            new ReadThreeVariableDataByIdRequest( $dataRequest )
        );

        $duration = microtime(1) - $startTime;

        $result = [
            $response->threeVariableDataByIdWithNamesAsArray(),
            'duration' => $duration
        ];

        return new JsonResponse($result, Response::HTTP_OK);
    }

}