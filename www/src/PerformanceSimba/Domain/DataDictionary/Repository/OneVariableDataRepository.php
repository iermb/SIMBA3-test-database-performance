<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableData;

interface OneVariableDataRepository
{
    public function save(OneVariableData $oneVariableData): void;

}