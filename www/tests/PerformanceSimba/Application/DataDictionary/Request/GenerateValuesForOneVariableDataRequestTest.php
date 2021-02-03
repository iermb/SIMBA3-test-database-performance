<?php

namespace App\tests\PerformanceSimba\Application\DataDictionary\Request;

use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForOneVariableDataRequest;
use PHPUnit\Framework\TestCase;

class GenerateValuesForOneVariableDataRequestTest extends TestCase
{
    private GenerateValuesForOneVariableDataRequest $generateValuesForOneVariableDataRequest;

    /** @test */
    public function shouldGenerateValuesForOneVariableDataRequestReturnNumberOfVariables(): void
    {
        $this->givenAGenerateValuesForOneVariableDataRequest();
        $this->thenReturnNumberOfVariables();
    }

    private function givenAGenerateValuesForOneVariableDataRequest(): void
    {
        $this->generateValuesForOneVariableDataRequest = new GenerateValuesForOneVariableDataRequest(24);
    }

    private function thenReturnNumberOfVariables(): void
    {
        $this->assertEquals(24, $this->generateValuesForOneVariableDataRequest->numberOfVariables());
    }
}
