<?php

namespace App\PerformanceSimba\Infrastructure\Controller;

use App\PerformanceSimba\Application\DataDictionary\UseCase\EmptyDatabaseUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EmptyDatabaseController
{
    private EmptyDatabaseUseCase $emptyDatabaseUseCase;

    public function __construct(
        EmptyDatabaseUseCase $emptyDatabaseUseCase
    ) {
        $this->emptyDatabaseUseCase = $emptyDatabaseUseCase;
    }

    public function execute(): Response
    {
        $this->emptyDatabaseUseCase->execute();
        return new JsonResponse('Database emptied', Response::HTTP_OK);
    }

}