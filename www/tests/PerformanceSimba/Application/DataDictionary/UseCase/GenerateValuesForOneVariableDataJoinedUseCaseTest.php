<?php

namespace App\tests\PerformanceSimba\Application\DataDictionary\UseCase;

use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForOneVariableDataJoinedRequest;
use App\PerformanceSimba\Application\DataDictionary\UseCase\GenerateValuesForOneVariableDataJoinedUseCase;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryJoinedRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataJoinedRepository;
use PHPUnit\Framework\TestCase;

class GenerateValuesForOneVariableDataJoinedUseCaseTest extends TestCase
{
    private GenerateValuesForOneVariableDataJoinedUseCase   $generateValuesForOneVariableDataJoinedUseCase;
    private GenerateValuesForOneVariableDataJoinedRequest       $generateValuesForOneVariableDataJoinedRequest;
    private OneVariableDataJoinedRepository                     $oneVariableDataJoinedRepository;
    private FirstVariableDictionaryJoinedRepository             $firstVariableJoinedDictionaryRepository;

    /** @test */
    public function shouldGenerateValueForOneVariableDataJoinedUseCaseSaveNumberOfOneVariableData(): void
    {
        $this->givenAGenerateValueForOneVariableJoinedDataUseCase();
        $this->whenGenerateValueForOneVariableDataJoinedRequestReturnNumberOfVariables();
        $this->thenExpectsSaveOneVariableDataJoinedNumberOfVariables();
        $this->whenExecuteGenerateValuesForOneVariableDataUseCase();
    }

    private function givenAGenerateValueForOneVariableJoinedDataUseCase(): void
    {
        $this->generateValuesForOneVariableDataJoinedUseCase = new GenerateValuesForOneVariableDataJoinedUseCase(
            $this->oneVariableDataJoinedRepository,
            $this->firstVariableJoinedDictionaryRepository
        );
    }

    private function whenGenerateValueForOneVariableDataJoinedRequestReturnNumberOfVariables(): void
    {
        $this->generateValuesForOneVariableDataJoinedRequest->method("numberOfVariables")->willReturn(28);
    }

    private function thenExpectsSaveOneVariableDataJoinedNumberOfVariables(): void
    {
        $this->oneVariableDataJoinedRepository->expects($this->once())->method("clean");
        $this->oneVariableDataJoinedRepository->expects($this->once())->method("saveMultiple");
        $this->firstVariableJoinedDictionaryRepository->expects($this->once())->method("clean");
        $this->firstVariableJoinedDictionaryRepository->expects($this->once())->method("saveMultiple");
    }

    private function whenExecuteGenerateValuesForOneVariableDataUseCase(): void
    {
        $this->generateValuesForOneVariableDataJoinedUseCase->execute($this->generateValuesForOneVariableDataJoinedRequest);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->generateValuesForOneVariableDataJoinedRequest = $this->createMock(GenerateValuesForOneVariableDataJoinedRequest::class);
        $this->oneVariableDataJoinedRepository = $this->createMock(OneVariableDataJoinedRepository::class);
        $this->firstVariableJoinedDictionaryRepository = $this->createMock(FirstVariableDictionaryJoinedRepository::class);
    }
}
