<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;

interface FirstVariableDictionaryRepository
{
    public function firstVariableDictionaryByIds(array $ids): array;

    public function save(FirstVariableDictionary $firstVariableDictionary): void;

    public function saveMultiple(array $arrayFirstVariableDictionary): void;

    public function clean(): void;

    public function allFirstVariableDictionary(): array;
}