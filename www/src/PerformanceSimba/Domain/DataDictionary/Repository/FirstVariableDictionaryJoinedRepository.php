<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionaryJoined;

interface FirstVariableDictionaryJoinedRepository
{
    public function save(FirstVariableDictionaryJoined $firstVariableDictionaryJoined): void;

    public function saveMultiple(array $arrayFirstVariableDictionaryJoined): void;

    public function clean(): void;
}