<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForOneVariableDataRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\GenerateValuesForOneVariableDataUseCase;
use Symfony\Component\HttpFoundation\Response;

class GenerateValuesForOneVariableDataController
{
    private GenerateValuesForOneVariableDataUseCase $generateValuesForOneVariableDataUseCase;

    public function __construct(GenerateValuesForOneVariableDataUseCase $generateValuesForOneVariableDataUseCase)
    {
        $this->generateValuesForOneVariableDataUseCase = $generateValuesForOneVariableDataUseCase;
    }

    public function execute(int $numberOfVariables): Response
    {
        try {
            $this->generateValuesForOneVariableDataUseCase->execute(new GenerateValuesForOneVariableDataRequest($numberOfVariables));
            return new Response("Saved", Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new Response($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

}