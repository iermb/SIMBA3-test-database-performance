<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\SecondVariableDictionaryJoined;

interface SecondVariableDictionaryJoinedRepository
{
    public function save(SecondVariableDictionaryJoined $secondVariableDictionaryJoined): void;

    public function saveMultiple(array $arraySecondVariableDictionaryJoined): void;

    public function clean(): void;
}