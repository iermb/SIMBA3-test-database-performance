<?php

namespace App\tests\PerformanceSimba\Application\DataDictionary\UseCase;

use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForOneVariableDataRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\GenerateValuesForOneVariableDataUseCase;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataRepository;
use PHPUnit\Framework\TestCase;

class GenerateValuesForOneVariableDataUseCaseTest extends TestCase
{
    private GenerateValuesForOneVariableDataUseCase $generateValuesForOneVariableDataUseCase;
    private GenerateValuesForOneVariableDataRequest $generateValuesForOneVariableDataRequest;
    private OneVariableDataRepository               $oneVariableDataRepository;

    /** @test */
    public function shouldGenerateValueForOneVariableDataUseCaseSaveNumberOfOneVariableData(): void
    {
        $this->givenAGenerateValueForOneVariableDataUseCase();
        $this->whenGenerateValueForOneVariableDataRequestReturnNumberOfVariables();
        $this->thenExpectsSaveOneVariableDataNumberOfVariables();
        $this->whenExecuteGenerateValuesForOneVariableDataUseCase();
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->generateValuesForOneVariableDataRequest = $this->createMock(GenerateValuesForOneVariableDataRequest::class);
        $this->oneVariableDataRepository = $this->createMock(OneVariableDataRepository::class);
    }

    private function givenAGenerateValueForOneVariableDataUseCase(): void
    {
        $this->generateValuesForOneVariableDataUseCase = new GenerateValuesForOneVariableDataUseCase($this->oneVariableDataRepository);
    }

    private function whenGenerateValueForOneVariableDataRequestReturnNumberOfVariables(): void
    {
        $this->generateValuesForOneVariableDataRequest->method("numberOfVariables")->willReturn(28);
    }

    private function thenExpectsSaveOneVariableDataNumberOfVariables(): void
    {
        $this->oneVariableDataRepository->expects($this->exactly(28))->method("save");
    }

    private function whenExecuteGenerateValuesForOneVariableDataUseCase(): void
    {
        $this->generateValuesForOneVariableDataUseCase->execute($this->generateValuesForOneVariableDataRequest);
    }
}
