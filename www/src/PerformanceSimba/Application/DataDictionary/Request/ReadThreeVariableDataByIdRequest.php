<?php


namespace App\PerformanceSimba\Application\DataDictionary\Request;


class ReadThreeVariableDataByIdRequest
{
    private array $ids1;
    private array $ids2;
    private array $ids3;

    public function __construct(array $ids1, array $ids2, array $ids3)
    {
        $this->ids1 = $ids1;
        $this->ids2 = $ids2;
        $this->ids3 = $ids3;
    }

    public function getIds1(): array
    {
        return $this->ids1;
    }

    public function getIds2(): array
    {
        return $this->ids2;
    }

    public function getIds3(): array
    {
        return $this->ids3;
    }
}