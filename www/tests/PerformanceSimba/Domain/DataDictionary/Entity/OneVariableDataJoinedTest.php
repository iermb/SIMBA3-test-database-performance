<?php

namespace App\tests\PerformanceSimba\Domain\DataDictionary\Entity;

use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableDataJoined;
use PHPUnit\Framework\TestCase;

class OneVariableDataJoinedTest extends TestCase
{
    private OneVariableDataJoined $oneVariableDataJoined;
    private FirstVariableDictionaryJoined $firstVariableDictionaryJoined;

    protected function setUp(): void
    {
        parent::setUp();
        $this->firstVariableDictionaryJoined = $this->createMock(FirstVariableDictionaryJoined::class);
    }

    /** @test */
    public function shouldOneVariableDataJoinedReturnFirstVarialeDictionaryAndValue(): void
    {
        $this->givenAnOneVariableDataJoined();
        $this->thenOneVariableDataJoinedReturnFirstVariableDictionaryAndValue();
    }

    private function givenAnOneVariableDataJoined(): void
    {
        $this->oneVariableDataJoined = new OneVariableDataJoined($this->firstVariableDictionaryJoined, 34.4);
    }

    private function thenOneVariableDataJoinedReturnFirstVariableDictionaryAndValue(): void
    {
        $this->assertSame($this->firstVariableDictionaryJoined, $this->oneVariableDataJoined->firstVariableDictionaryJoined());
        $this->assertEquals(34.4, $this->oneVariableDataJoined->value());
    }
}
