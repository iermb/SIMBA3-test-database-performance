<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableDataJoined;

interface OneVariableDataJoinedRepository
{
    public function allOneVariableDataJoined(): array;

    public function save(OneVariableDataJoined $oneVariableDataJoined): void;

    public function clean(): void;
}