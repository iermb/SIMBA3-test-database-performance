<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\SecondVariableDictionary;

interface SecondVariableDictionaryRepository
{
    public function secondVariableDictionaryByIds(array $ids): array;

    public function save(SecondVariableDictionary $secondVariableDictionary): void;

    public function saveMultiple(array $arraySecondVariableDictionary): void;

    public function clean(): void;

    public function allSecondVariableDictionary(): array;
}