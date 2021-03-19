<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\SecondVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Repository\SecondVariableDictionaryRepository;

class FilePersistSecondVariableDictionaryRepository extends FileRepository implements SecondVariableDictionaryRepository
{
    private const FILENAME_SECOND_VARIABLE_DICTIONARY = "../upload/importSecondVariableDictionaryRepository";

    private SecondVariableDictionaryRepository $secondVariableDictionaryRepository;

    public function __construct(SecondVariableDictionaryRepository $secondVariableDictionaryRepository)
    {
        parent::__construct(self::FILENAME_SECOND_VARIABLE_DICTIONARY);
        $this->secondVariableDictionaryRepository = $secondVariableDictionaryRepository;
    }

    public function secondVariableDictionaryByIds(array $ids): array
    {
        $this->secondVariableDictionaryRepository->secondVariableDictionaryByIds($ids);
    }

    public function save(SecondVariableDictionary $secondVariableDictionary): void
    {
        $this->saveQuery($secondVariableDictionary);
    }

    public function saveMultiple(array $arraySecondVariableDictionary): void
    {
        array_map(array($this, "saveQuery"), $arraySecondVariableDictionary);
    }

    public function clean(): void
    {
        return;
    }

    public function allSecondVariableDictionary(): array
    {
        $this->secondVariableDictionaryRepository->allSecondVariableDictionary();
    }

    private function saveQuery(SecondVariableDictionary $secondVariableDictionary): void
    {
        $this->writeLine("INSERT INTO second_variable_dictionary (id, value) VALUES (" . $secondVariableDictionary->id() . ",'" . $secondVariableDictionary->name() . "');");
    }
}