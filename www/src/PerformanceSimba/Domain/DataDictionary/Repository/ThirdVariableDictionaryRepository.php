<?php


namespace App\PerformanceSimba\Domain\DataDictionary\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\ThirdVariableDictionary;

interface ThirdVariableDictionaryRepository
{
    public function thirdVariableDictionaryByIds(array $ids): array;

    public function save(ThirdVariableDictionary $thirdVariableDictionary): void;

    public function saveMultiple(array $arrayThirdVariableDictionary): void;

    public function clean(): void;

    public function allThirdVariableDictionary(): array;
}