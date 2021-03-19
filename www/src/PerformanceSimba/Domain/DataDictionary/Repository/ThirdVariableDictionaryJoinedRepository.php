<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\ThirdVariableDictionaryJoined;

interface ThirdVariableDictionaryJoinedRepository
{
    public function save(ThirdVariableDictionaryJoined $thirdVariableDictionaryJoined): void;

    public function saveMultiple(array $arrayThirdVariableDictionaryJoined): void;

    public function clean(): void;
}