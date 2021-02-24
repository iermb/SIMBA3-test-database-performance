<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\ThreeVariableData;

interface ThreeVariableDataRepository
{
    public function setIds1(array $ids1): void;

    public function setIds2(array $ids2): void;

    public function setIds3(array $ids3): void;

    public function threeVariableDataByIds(): array;

    public function save(ThreeVariableData $threeVariableData): void;

    public function saveMultiple(array $arrayThreeVariableData): void;

    public function clean(): void;

    public function allThreeVariableData(): array;
}