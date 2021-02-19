<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\Request\ReadThreeVariableDataJoinedByIdRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadThreeVariableDataJoinedByIdWithNamesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReadThreeVariableDataJoinedByIdWithNamesController
{
    private const FIELD_HEADER_VARS_1 = 'ids_1';
    private const FIELD_HEADER_VARS_2 = 'ids_2';
    private const FIELD_HEADER_VARS_3 = 'ids_3';

    private ReadThreeVariableDataJoinedByIdWithNamesUseCase $readThreeVariableDataJoinedByIdWithNamesUseCase;

    public function __construct(
        ReadThreeVariableDataJoinedByIdWithNamesUseCase $readThreeVariableDataJoinedByIdWithNamesUseCase
    ) {
        $this->readThreeVariableDataJoinedByIdWithNamesUseCase = $readThreeVariableDataJoinedByIdWithNamesUseCase;
    }

    public function execute(Request $request): Response
    {
        $startTime = microtime(1);

        $response = $this->readThreeVariableDataJoinedByIdWithNamesUseCase->execute(
            new ReadThreeVariableDataJoinedByIdRequest(
                /*
                 * Values should be parsed from url, instead of headers, being a get request
                 * */
                '101',/*$request->headers->get(self::FIELD_HEADER_VARS_1),*/
               '101',/* $request->headers->get(self::FIELD_HEADER_VARS_2),*/
                '101'/*$request->headers->get(self::FIELD_HEADER_VARS_3)*/
            )
        );

        $duration = microtime(1) - $startTime;

        $result = [
            $response->threeVariableDataJoinedByIdWithNamesAsArray(),
            'duration' => $duration
        ];

        return new JsonResponse($result, Response::HTTP_OK);
    }

}