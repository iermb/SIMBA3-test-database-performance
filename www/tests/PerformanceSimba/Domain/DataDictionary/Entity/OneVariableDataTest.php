<?php

namespace App\Tests\PerformanceSimba\Domain\DataDictionary\Entity;

use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableData;
use PHPUnit\Framework\TestCase;

class OneVariableDataTest extends TestCase
{
    private OneVariableData $oneVariableData;

    /** @test */
    public function shouldOneVariableDataReturnVariableIdAndValue(): void
    {
        $this->givenAnOneVariableData();
        $this->thenReturnVariableIdAndValue();
    }

    private function givenAnOneVariableData(): void
    {
        $this->oneVariableData = new OneVariableData(2, 45.6);
    }

    private function thenReturnVariableIdAndValue(): void
    {
        $this->assertEquals(2, $this->oneVariableData->variableId());
        $this->assertEquals(45.6, $this->oneVariableData->value());
    }
}
