<?php

namespace App\Tests\PerformanceSimba\Domain\DataDictionary\Entity;

use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionaryJoined;
use PHPUnit\Framework\TestCase;

class FirstVariableDictionaryJoinedTest extends TestCase
{
    private FirstVariableDictionaryJoined $firstVariableDictionaryJoined;

    /** @test */
    public function shouldFirstVariableDictionaryReturnIdAndName(): void
    {
        $this->givenAFirstVariableDictionaryJoined();
        $this->thenReturnIdAndName();
    }

    private function givenAFirstVariableDictionaryJoined(): void
    {
        $this->firstVariableDictionaryJoined = new FirstVariableDictionaryJoined(2, "Test name dictionary");
    }

    private function thenReturnIdAndName(): void
    {
        $this->assertEquals(2, $this->firstVariableDictionaryJoined->id());
        $this->assertEquals("Test name dictionary", $this->firstVariableDictionaryJoined->name());
    }
}
