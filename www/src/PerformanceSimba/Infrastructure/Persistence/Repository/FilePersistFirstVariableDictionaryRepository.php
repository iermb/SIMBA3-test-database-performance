<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryRepository;

class FilePersistFirstVariableDictionaryRepository extends FileRepository implements FirstVariableDictionaryRepository
{
    private const FILENAME_FIRST_VARIABLE_DICTIONARY = "../upload/importFirstVariableDictionaryRepository";

    private FirstVariableDictionaryRepository $firstVariableDictionaryRepository;

    public function __construct(FirstVariableDictionaryRepository $firstVariableDictionaryRepository)
    {
        parent::__construct(self::FILENAME_FIRST_VARIABLE_DICTIONARY);
        $this->firstVariableDictionaryRepository = $firstVariableDictionaryRepository;
    }


    public function firstVariableDictionaryByIds(array $ids): array
    {
        return $this->firstVariableDictionaryRepository->firstVariableDictionaryByIds($ids);
    }

    public function save(FirstVariableDictionary $firstVariableDictionary): void
    {
        $this->saveQuery($firstVariableDictionary);
    }

    public function saveMultiple(array $arrayFirstVariableDictionary): void
    {
        array_map(array($this, "saveQuery"), $arrayFirstVariableDictionary);
    }

    public function clean(): void
    {
        return;
    }

    public function allFirstVariableDictionary(): array
    {
        return $this->firstVariableDictionaryRepository->allFirstVariableDictionary();
    }

    private function saveQuery(FirstVariableDictionary $firstVariableDictionary): void
    {
        $this->writeLine("INSERT INTO first_variable_dictionary (id, value) VALUES (" . $firstVariableDictionary->id() . ", '" . $firstVariableDictionary->name() . "');");
    }
}