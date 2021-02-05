<?php

namespace App\tests\PerformanceSimba\Application\DataDictionary\Response;

use App\PerformanceSimba\Application\DataDictionary\Response\ReadAllOneVariableDataJoinedWithNamesResponse;
use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableDataJoined;
use PHPUnit\Framework\TestCase;

class ReadAllOneVariableDataJoinedWithNamesResponseTest extends TestCase
{
    private ReadAllOneVariableDataJoinedWithNamesResponse $readAllOneVariableDataJoinedWithNamesResponse;
    private array                                         $listOneVariableDataJoined;
    private OneVariableDataJoined                         $oneVariableDataJoined1;
    private OneVariableDataJoined                         $oneVariableDataJoined2;
    private FirstVariableDictionary                       $firstVariableDictionary1;
    private FirstVariableDictionary                       $firstVariableDictionary2;

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
        $this->assertEquals(["firstVariableNames" => [], "values" => []],
            $this->readAllOneVariableDataJoinedWithNamesResponse->allOneVariableDataWithNamesAsArray());
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
        $this->assertEquals([
            "firstVariableNames" => [["var1_id" => 1, "name" => "Test name 1"]],
            "values" => [["var1_id" => 1, "value" => 34.56]]
        ],
            $this->readAllOneVariableDataJoinedWithNamesResponse->allOneVariableDataWithNamesAsArray());
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
            "values" => [["var1_id" => 1, "value" => 34.56], ["var1_id" => 2, "value" => 45.32]]
        ],
            $this->readAllOneVariableDataJoinedWithNamesResponse->allOneVariableDataWithNamesAsArray());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->listOneVariableDataJoined = array();
        $this->firstVariableDictionary1 = $this->createMock(FirstVariableDictionary::class);
        $this->firstVariableDictionary1->method("id")->willReturn(1);
        $this->firstVariableDictionary1->method("name")->willReturn("Test name 1");
        $this->firstVariableDictionary2 = $this->createMock(FirstVariableDictionary::class);
        $this->firstVariableDictionary2->method("id")->willReturn(2);
        $this->firstVariableDictionary2->method("name")->willReturn("Test name 2");
        $this->oneVariableDataJoined1 = $this->createMock(OneVariableDataJoined::class);
        $this->oneVariableDataJoined1->method("firstVariableDictionary")->willReturn($this->firstVariableDictionary1);
        $this->oneVariableDataJoined1->method("value")->willReturn(34.56);
        $this->oneVariableDataJoined2 = $this->createMock(OneVariableDataJoined::class);
        $this->oneVariableDataJoined2->method("firstVariableDictionary")->willReturn($this->firstVariableDictionary2);
        $this->oneVariableDataJoined2->method("value")->willReturn(45.32);
    }

}
