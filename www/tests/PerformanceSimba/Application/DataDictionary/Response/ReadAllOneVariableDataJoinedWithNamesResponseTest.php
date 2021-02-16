<?php

namespace App\tests\PerformanceSimba\Application\DataDictionary\Response;

use App\PerformanceSimba\Application\DataDictionary\Response\ReadAllOneVariableDataJoinedWithNamesResponse;
use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableDataJoined;
use PHPUnit\Framework\TestCase;

class ReadAllOneVariableDataJoinedWithNamesResponseTest extends TestCase
{
    private ReadAllOneVariableDataJoinedWithNamesResponse $readAllOneVariableDataJoinedWithNamesResponse;
    private array                                         $listOneVariableDataJoined;
    private OneVariableDataJoined                         $oneVariableDataJoined1;
    private OneVariableDataJoined                         $oneVariableDataJoined2;
    private FirstVariableDictionaryJoined                 $firstVariableDictionaryJoined1;
    private FirstVariableDictionaryJoined                 $firstVariableDictionaryJoined2;

    /** @test */
    public function shouldReadAllOneVariableDataJoinedWithNamesResponseWithoutOneVariableDataJoinedReturnArray(
    ): void
    {
        $this->givenAListOneVariableDataJoinedWithNoElements();
        $this->givenAReadAllOneVariableDataJoinedWithNamesResponse();
        $this->thenReturnValuesAsArrayWithoutOneVariableDataJoined();
    }

    private function givenAListOneVariableDataJoinedWithNoElements(): void
    {
        $this->listOneVariableDataJoined = array();
    }

    private function givenAReadAllOneVariableDataJoinedWithNamesResponse(): void
    {
        $this->readAllOneVariableDataJoinedWithNamesResponse = new ReadAllOneVariableDataJoinedWithNamesResponse($this->listOneVariableDataJoined);
    }

    private function thenReturnValuesAsArrayWithoutOneVariableDataJoined(): void
    {
        $this->assertEquals(
            ["firstVariableNames" => [], "values" => []],
            $this->readAllOneVariableDataJoinedWithNamesResponse->allOneVariableDataJoinedWithNamesAsArray()
        );
    }

    /** @test */
    public function shouldReadAllOneVariableDataWithNamesResponseWithOneOneVariableDataJoinedReturnArray(
    ): void
    {
        $this->givenAListOneVariableDataJoinedWithOneElement();
        $this->givenAReadAllOneVariableDataJoinedWithNamesResponse();
        $this->thenReturnValuesAsArrayWithOneOneVariableDataJoined();
    }

    private function givenAListOneVariableDataJoinedWithOneElement(): void
    {
        $this->listOneVariableDataJoined = [$this->oneVariableDataJoined1];
    }

    private function thenReturnValuesAsArrayWithOneOneVariableDataJoined(): void
    {
        $this->assertEquals(
            [
                "firstVariableNames" => [
                    ["var1_id" => 1, "name" => "Test name 1"]
                ],
                "values" => [[1,34.56]]
            ],
            $this->readAllOneVariableDataJoinedWithNamesResponse->allOneVariableDataJoinedWithNamesAsArray());
    }

    /** @test */
    public function shouldReadAllOneVariableDataWithNamesResponseWithTwoOneVariableDataJoinedReturnArray(
    ): void
    {
        $this->givenAListOneVariableDataWithTwoElements();
        $this->givenAReadAllOneVariableDataJoinedWithNamesResponse();
        $this->thenReturnValuesAsArrayWithTwoOneVariableDataJoined();
    }

    private function givenAListOneVariableDataWithTwoElements(): void
    {
        $this->listOneVariableDataJoined = [$this->oneVariableDataJoined1, $this->oneVariableDataJoined2];
    }

    private function thenReturnValuesAsArrayWithTwoOneVariableDataJoined(): void
    {
        $this->assertEquals([
            "firstVariableNames" => [
                ["var1_id" => 1, "name" => "Test name 1"],
                ["var1_id" => 2, "name" => "Test name 2"]
            ],
            "values" => [[1, 34.56], [2,45.32]]
        ],
            $this->readAllOneVariableDataJoinedWithNamesResponse->allOneVariableDataJoinedWithNamesAsArray());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->listOneVariableDataJoined = array();
        $this->firstVariableDictionaryJoined1 = $this->createMock(FirstVariableDictionaryJoined::class);
        $this->firstVariableDictionaryJoined1->method("id")->willReturn(1);
        $this->firstVariableDictionaryJoined1->method("name")->willReturn("Test name 1");
        $this->firstVariableDictionaryJoined2 = $this->createMock(FirstVariableDictionaryJoined::class);
        $this->firstVariableDictionaryJoined2->method("id")->willReturn(2);
        $this->firstVariableDictionaryJoined2->method("name")->willReturn("Test name 2");
        $this->oneVariableDataJoined1 = $this->createMock(OneVariableDataJoined::class);
        $this->oneVariableDataJoined1->method("firstVariableDictionaryJoined")->willReturn($this->firstVariableDictionaryJoined1);
        $this->oneVariableDataJoined1->method("value")->willReturn(34.56);
        $this->oneVariableDataJoined2 = $this->createMock(OneVariableDataJoined::class);
        $this->oneVariableDataJoined2->method("firstVariableDictionaryJoined")->willReturn($this->firstVariableDictionaryJoined2);
        $this->oneVariableDataJoined2->method("value")->willReturn(45.32);
    }

}
