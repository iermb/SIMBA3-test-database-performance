<?php

namespace App\Tests\PerformanceSimba\Domain\DataDictionary\Entity;

use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;
use PHPUnit\Framework\TestCase;

class FirstVariableDictionaryTest extends TestCase
{
    private FirstVariableDictionary $firstVariableDictionary;

    /** @test */
    public function shouldFirstVariableDictionaryReturnIdAndName(): void
    {
        $this->givenAFirstVariableDictionary();
        $this->thenReturnIdAndName();
    }

    private function givenAFirstVariableDictionary(): void
    {
        $this->firstVariableDictionary = new FirstVariableDictionary(2, "Test name dictionary");
    }

    private function thenReturnIdAndName(): void
    {
        $this->assertEquals(2, $this->firstVariableDictionary->id());
        $this->assertEquals("Test name dictionary", $this->firstVariableDictionary->name());
    }
}
