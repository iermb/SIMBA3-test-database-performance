<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\Request\ReadThreeVariableDataByIdRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadThreeVariableDataByIdWithNamesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReadThreeVariableDataByIdWithNamesController
{
    private const FIELD_HEADER_VARS_1 = 'ids_1';
    private const FIELD_HEADER_VARS_2 = 'ids_2';
    private const FIELD_HEADER_VARS_3 = 'ids_3';

    private ReadThreeVariableDataByIdWithNamesUseCase $readThreeVariableDataByIdWithNamesUseCase;

    public function __construct(
        ReadThreeVariableDataByIdWithNamesUseCase $readThreeVariableDataByIdWithNamesUseCase
    ) {
        $this->readThreeVariableDataByIdWithNamesUseCase = $readThreeVariableDataByIdWithNamesUseCase;
    }

    public function execute(string $jsonRequest): Response
    {
        $dataRequest = json_decode($jsonRequest, true);

        $varsFirst = isset($dataRequest[self::FIELD_HEADER_VARS_1]) ? $dataRequest[self::FIELD_HEADER_VARS_1] : '';
        $varsSecond = isset($dataRequest[self::FIELD_HEADER_VARS_2]) ? $dataRequest[self::FIELD_HEADER_VARS_2] : '';
        $varsThird = isset($dataRequest[self::FIELD_HEADER_VARS_3]) ? $dataRequest[self::FIELD_HEADER_VARS_3] : '';

        $startTime = microtime(1);

        $response = $this->readThreeVariableDataByIdWithNamesUseCase->execute(
            new ReadThreeVariableDataByIdRequest( $varsFirst, $varsSecond, $varsThird)
        );

        $duration = microtime(1) - $startTime;

        $result = [
            $response->threeVariableDataByIdWithNamesAsArray(),
            'duration' => $duration
        ];

        return new JsonResponse($result, Response::HTTP_OK);
    }

}