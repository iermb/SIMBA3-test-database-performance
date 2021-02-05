<?php

namespace App\tests\PerformanceSimba\Application\DataDictionary\UseCase;

use App\PerformanceSimba\Application\DataDictionary\Response\ReadAllOneVariableDataJoinedWithNamesResponse;
use App\PerformanceSimba\Application\DataDictionary\UseCase\ReadAllOneVariableDataJoinedWithNamesUseCase;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataJoinedRepository;
use PHPUnit\Framework\TestCase;

class ReadAllOneVariableDataJoinedWithNamesUseCaseTest extends TestCase
{
    private ReadAllOneVariableDataJoinedWithNamesUseCase $readAllOneVariableDataJoinedWithNamesUseCase;
    private OneVariableDataJoinedRepository              $oneVariableDataJoinedRepository;

    /** @test */
    public function shouldReadAllVariableDataJoinedWithNamesReturnReadAllVariableDataJoinedWithNamesResponse(): void
    {
        $this->givenAReadAllVariableDataJoinedWithNamesUseCase();
        $this->thenReturnReadAllVariableDataJoinedWithNamesUseCase();
    }

    private function givenAReadAllVariableDataJoinedWithNamesUseCase(): void
    {
        $this->readAllOneVariableDataJoinedWithNamesUseCase = new ReadAllOneVariableDataJoinedWithNamesUseCase($this->oneVariableDataJoinedRepository);
    }

    private function thenReturnReadAllVariableDataJoinedWithNamesUseCase(): void
    {
        $this->assertInstanceOf(ReadAllOneVariableDataJoinedWithNamesResponse::class,
            $this->readAllOneVariableDataJoinedWithNamesUseCase->execute());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->oneVariableDataJoinedRepository = $this->createMock(OneVariableDataJoinedRepository::class);
    }
}
