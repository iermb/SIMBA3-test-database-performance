<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\ThreeVariableDataJoined;

interface ThreeVariableDataJoinedRepository
{
    public function setIds1(array $ids1): void;

    public function setIds2(array $ids2): void;

    public function setIds3(array $ids3): void;

    public function threeVariableDataJoinedByIds(): array;

    public function allThreeVariableDataJoined(): array;

    public function save(ThreeVariableDataJoined $threeVariableDataJoined): void;

    public function saveMultiple(array $arrayThreeVariableDataJoined): void;

    public function clean(): void;
}