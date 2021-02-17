<?php

namespace App\tests\PerformanceSimba\Application\DataDictionary\Request;

use App\PerformanceSimba\Application\DataDictionary\Request\GenerateValuesForOneVariableDataJoinedRequest;
use PHPUnit\Framework\TestCase;

class GenerateValuesForOneVariableDataJoinedRequestTest extends TestCase
{
    private GenerateValuesForOneVariableDataJoinedRequest $generateValuesForOneVariableDataJoinedRequest;

    /** @test */
    public function shouldGenerateValuesForOneVariableDataJoinedRequestReturnNumberOfVariables(): void
    {
        $this->givenAGenerateValuesForOneVariableDataJoinedRequest();
        $this->thenReturnNumberOfVariables();
    }

    private function givenAGenerateValuesForOneVariableDataJoinedRequest(): void
    {
        $this->generateValuesForOneVariableDataJoinedRequest = new GenerateValuesForOneVariableDataJoinedRequest(24);
    }

    private function thenReturnNumberOfVariables(): void
    {
        $this->assertEquals(24, $this->generateValuesForOneVariableDataJoinedRequest->numberOfVariables());
    }
}
