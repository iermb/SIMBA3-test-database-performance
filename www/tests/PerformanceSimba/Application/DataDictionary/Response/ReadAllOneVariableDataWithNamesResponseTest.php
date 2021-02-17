<?php

namespace App\tests\PerformanceSimba\Application\DataDictionary\Response;

use App\PerformanceSimba\Application\DataDictionary\Response\ReadAllOneVariableDataWithNamesResponse;
use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableData;
use PHPUnit\Framework\TestCase;

class ReadAllOneVariableDataWithNamesResponseTest extends TestCase
{
    private ReadAllOneVariableDataWithNamesResponse $readAllOneVariableDataWithNamesResponse;
    private array                                   $listOneVariableData;
    private array                                   $listFirstVariableDictionary;
    private OneVariableData                         $oneVariableData1;
    private OneVariableData                         $oneVariableData2;
    private FirstVariableDictionary                 $firstVariableDictionary1;
    private FirstVariableDictionary                 $firstVariableDictionary2;

    /** @test */
    public function shouldReadAllOneVariableDataWithNamesResponseWithoutOneVariableDataAndFirstVariableDictionaryReturnArray(
    ): void
    {
        $this->givenAListOneVariableDataWithNoElements();
        $this->givenAListFirstVariableDictionaryWithNoElements();
        $this->givenAReadAllOneVariableDataWithNamesResponse();
        $this->thenReturnValuesAsArrayWithoutOneVariableDataAndFirstVariableDictionary();
    }

    private function givenAReadAllOneVariableDataWithNamesResponse(): void
    {
        $this->readAllOneVariableDataWithNamesResponse = new ReadAllOneVariableDataWithNamesResponse($this->listOneVariableData,
            $this->listFirstVariableDictionary);
    }

    private function givenAListOneVariableDataWithNoElements(): void
    {
        $this->listOneVariableData = array();
    }

    private function givenAListFirstVariableDictionaryWithNoElements(): void
    {
        $this->listFirstVariableDictionary = array();
    }

    private function thenReturnValuesAsArrayWithoutOneVariableDataAndFirstVariableDictionary(): void
    {
        $this->assertEquals(["firstVariableNames" => [], "values" => []],
            $this->readAllOneVariableDataWithNamesResponse->allOneVariableDataWithNamesAsArray());
    }

    /** @test */
    public function shouldReadAllOneVariableDataWithNamesResponseWithOneOneVariableDataAndOneFirstVariableDictionaryReturnArray(
    ): void
    {

        $this->givenAListOneVariableDataWithOneElement();
        $this->givenAListFirstVariableDictionaryWithOneElement();
        $this->givenAReadAllOneVariableDataWithNamesResponse();
        $this->thenReturnValuesAsArrayWithOneOneVariableDataAndOneFirstVariableDictionary();
    }

    private function givenAListOneVariableDataWithOneElement(): void
    {
        $this->listOneVariableData = [$this->oneVariableData1];
    }

    private function givenAListFirstVariableDictionaryWithOneElement(): void
    {
        $this->listFirstVariableDictionary = [$this->firstVariableDictionary1];
    }

    private function thenReturnValuesAsArrayWithOneOneVariableDataAndOneFirstVariableDictionary(): void
    {
        $this->assertEquals([
            "firstVariableNames" => [["var1_id" => 1, "name" => "Test name 1"]],
            "values" => [[1, 34.56]]
        ],
            $this->readAllOneVariableDataWithNamesResponse->allOneVariableDataWithNamesAsArray());
    }

    /** @test */
    public function shouldReadAllOneVariableDataWithNamesResponseWithTwoOneVariableDataAndTwoFirstVariableDictionaryReturnArray(
    ): void
    {

        $this->givenAListOneVariableDataWithTwoElements();
        $this->givenAListFirstVariableDictionaryWithTwoElements();
        $this->givenAReadAllOneVariableDataWithNamesResponse();
        $this->thenReturnValuesAsArrayWithTwoOneVariableDataAndTwoFirstVariableDictionary();
    }

    private function givenAListOneVariableDataWithTwoElements(): void
    {
        $this->listOneVariableData = [$this->oneVariableData1, $this->oneVariableData2];
    }

    private function givenAListFirstVariableDictionaryWithTwoElements(): void
    {
        $this->listFirstVariableDictionary = [$this->firstVariableDictionary1, $this->firstVariableDictionary2];
    }

    private function thenReturnValuesAsArrayWithTwoOneVariableDataAndTwoFirstVariableDictionary(): void
    {
        $this->assertEquals([
            "firstVariableNames" => [
                ["var1_id" => 1, "name" => "Test name 1"],
                ["var1_id" => 2, "name" => "Test name 2"]
            ],
            "values" => [[1, 34.56], [2, 45.32]]
        ],
            $this->readAllOneVariableDataWithNamesResponse->allOneVariableDataWithNamesAsArray());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->listOneVariableData = array();
        $this->listFirstVariableDictionary = array();
        $this->oneVariableData1 = $this->createMock(OneVariableData::class);
        $this->oneVariableData1->method("variableId")->willReturn(1);
        $this->oneVariableData1->method("value")->willReturn(34.56);
        $this->oneVariableData2 = $this->createMock(OneVariableData::class);
        $this->oneVariableData2->method("variableId")->willReturn(2);
        $this->oneVariableData2->method("value")->willReturn(45.32);
        $this->firstVariableDictionary1 = $this->createMock(FirstVariableDictionary::class);
        $this->firstVariableDictionary1->method("id")->willReturn(1);
        $this->firstVariableDictionary1->method("name")->willReturn("Test name 1");
        $this->firstVariableDictionary2 = $this->createMock(FirstVariableDictionary::class);
        $this->firstVariableDictionary2->method("id")->willReturn(2);
        $this->firstVariableDictionary2->method("name")->willReturn("Test name 2");
    }
}
