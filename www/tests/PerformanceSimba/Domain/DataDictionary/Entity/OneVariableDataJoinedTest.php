<?php

namespace App\tests\PerformanceSimba\Domain\DataDictionary\Entity;

use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableDataJoined;
use PHPUnit\Framework\TestCase;

class OneVariableDataJoinedTest extends TestCase
{
    private OneVariableDataJoined $oneVariableDataJoined;
    private FirstVariableDictionary $firstVariableDictionary;

    protected function setUp(): void
    {
        parent::setUp();
        $this->firstVariableDictionary = $this->createMock(FirstVariableDictionary::class);
    }

    /** @test */
    public function shouldOneVariableDataJoinedReturnFirstVarialeDictionaryAndValue(): void
    {
        $this->givenAnOneVariableDataJoined();
        $this->thenOneVariableDataJoinedReturnFirstVariableDictionaryAndValue();
    }

    private function givenAnOneVariableDataJoined(): void
    {
        $this->oneVariableDataJoined = new OneVariableDataJoined($this->firstVariableDictionary, 34.4);
    }

    private function thenOneVariableDataJoinedReturnFirstVariableDictionaryAndValue(): void
    {
        $this->assertSame($this->firstVariableDictionary, $this->oneVariableDataJoined->firstVariableDictionary());
        $this->assertEquals(34.4, $this->oneVariableDataJoined->value());
    }
}
