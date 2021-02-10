<?php


namespace App\PerformanceSimba\Infrastructure\Controller;


use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForOneVariableDataRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\GenerateValuesForOneVariableDataUseCase;
use Symfony\Component\HttpFoundation\Response;

class GenerateValuesForOneVariableDataController
{
    private GenerateValuesForOneVariableDataUseCase $generateValuesForOneCariableDataUseCase;

    public function __construct(GenerateValuesForOneVariableDataUseCase $generateValuesForOneCariableDataUseCase)
    {
        $this->generateValuesForOneCariableDataUseCase = $generateValuesForOneCariableDataUseCase;
    }

    public function execute(int $numberOfVariables): Response
    {
        try {
            $this->generateValuesForOneCariableDataUseCase->execute(new GenerateValuesForOneVariableDataRequest($numberOfVariables));
            return new Response("Saved", Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new Response($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

}