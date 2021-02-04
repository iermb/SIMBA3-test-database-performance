<?php

namespace App\tests\PerformanceSimba\Application\DataDictionary\UseCase;

use App\PerformanceSimba\Application\DataDictionary\Response\ReadAllOneVariableDataWithNamesResponse;
use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadAllOneVariableDataWithNamesUseCase;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryRepository;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataRepository;
use PHPUnit\Framework\TestCase;

class ReadAllOneVariableDataWithNamesUseCaseTest extends TestCase
{
    private ReadAllOneVariableDataWithNamesUseCase $readAllOneVariableDataWithNamesUseCase;
    private OneVariableDataRepository              $oneVariableDataRespository;
    private FirstVariableDictionaryRepository      $firstVariableDictionaryRepository;

    /** @test */
    public function shouldReadAllOneVariableDataWithNamesUseCaseThenReturnReadAllOneVariableDataWithNamesResponse(
    ): void
    {
        $this->givenAReadAllOneVariableDataWithNamesUseCase();
        $this->thenReturnReadAllOneVariableDataWithNamesResponse();
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->oneVariableDataRespository = $this->createMock(OneVariableDataRepository::class);
        $this->firstVariableDictionaryRepository = $this->createMock(FirstVariableDictionaryRepository::class);
    }

    private function givenAReadAllOneVariableDataWithNamesUseCase(): void
    {
        $this->readAllOneVariableDataWithNamesUseCase = new ReadAllOneVariableDataWithNamesUseCase($this->oneVariableDataRespository,
            $this->firstVariableDictionaryRepository);
    }

    private function thenReturnReadAllOneVariableDataWithNamesResponse(): void
    {
        $this->assertInstanceOf(ReadAllOneVariableDataWithNamesResponse::class,
            $this->readAllOneVariableDataWithNamesUseCase->execute());
    }
}
