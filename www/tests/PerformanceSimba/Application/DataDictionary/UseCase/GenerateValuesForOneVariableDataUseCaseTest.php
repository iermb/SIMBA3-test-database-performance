<?php

namespace App\tests\PerformanceSimba\Application\DataDictionary\UseCase;

use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForOneVariableDataRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\GenerateValuesForOneVariableDataUseCase;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataJoinedRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataRepository;
use PHPUnit\Framework\TestCase;

class GenerateValuesForOneVariableDataUseCaseTest extends TestCase
{
    private GenerateValuesForOneVariableDataUseCase $generateValuesForOneVariableDataUseCase;
    private GenerateValuesForOneVariableDataRequest $generateValuesForOneVariableDataRequest;
    private OneVariableDataRepository               $oneVariableDataRepository;
    private FirstVariableDictionaryRepository       $firstVariableDictionaryRepository;
    private OneVariableDataJoinedRepository         $oneVariableDataJoinedRepository;

    /** @test */
    public function shouldGenerateValueForOneVariableDataUseCaseSaveNumberOfOneVariableData(): void
    {
        $this->givenAGenerateValueForOneVariableDataUseCase();
        $this->whenGenerateValueForOneVariableDataRequestReturnNumberOfVariables();
        $this->thenExpectsSaveOneVariableDataNumberOfVariables();
        $this->whenExecuteGenerateValuesForOneVariableDataUseCase();
    }

    private function givenAGenerateValueForOneVariableDataUseCase(): void
    {
        $this->generateValuesForOneVariableDataUseCase = new GenerateValuesForOneVariableDataUseCase(
            $this->oneVariableDataRepository,
            $this->firstVariableDictionaryRepository,
            $this->oneVariableDataJoinedRepository
        );
    }

    private function whenGenerateValueForOneVariableDataRequestReturnNumberOfVariables(): void
    {
        $this->generateValuesForOneVariableDataRequest->method("numberOfVariables")->willReturn(28);
    }

    private function thenExpectsSaveOneVariableDataNumberOfVariables(): void
    {
        $this->oneVariableDataRepository->expects($this->once())->method("clean");
        $this->oneVariableDataRepository->expects($this->exactly(28))->method("save");
        $this->firstVariableDictionaryRepository->expects($this->once())->method("clean");
        $this->firstVariableDictionaryRepository->expects($this->exactly(28))->method("save");
        $this->oneVariableDataJoinedRepository->expects($this->once())->method("clean");
        $this->oneVariableDataJoinedRepository->expects($this->exactly(28))->method("save");
    }

    private function whenExecuteGenerateValuesForOneVariableDataUseCase(): void
    {
        $this->generateValuesForOneVariableDataUseCase->execute($this->generateValuesForOneVariableDataRequest);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->generateValuesForOneVariableDataRequest = $this->createMock(GenerateValuesForOneVariableDataRequest::class);
        $this->oneVariableDataRepository = $this->createMock(OneVariableDataRepository::class);
        $this->firstVariableDictionaryRepository = $this->createMock(FirstVariableDictionaryRepository::class);
        $this->oneVariableDataJoinedRepository = $this->createMock(OneVariableDataJoinedRepository::class);
    }
}
