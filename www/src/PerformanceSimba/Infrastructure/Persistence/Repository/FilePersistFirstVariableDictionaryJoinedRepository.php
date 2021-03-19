<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;

use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryJoinedRepository;

class FilePersistFirstVariableDictionaryJoinedRepository extends FileRepository implements
    FirstVariableDictionaryJoinedRepository
{
    private const FILENAME_FIRST_VARIABLE_DICTIONARY_JOINED = "../upload/importFirstVariableDictionaryJoinedRepository";

    public function __construct()
    {
        parent::__construct(self::FILENAME_FIRST_VARIABLE_DICTIONARY_JOINED);
    }

    public function save(FirstVariableDictionaryJoined $firstVariableDictionaryJoined): void
    {
        $this->saveQuery($firstVariableDictionaryJoined);
    }

    public function saveMultiple(array $arrayFirstVariableDictionaryJoined): void
    {
        array_map(array($this, "saveQuery"), $arrayFirstVariableDictionaryJoined);
    }

    public function clean(): void
    {
        return;
    }

    private function saveQuery(FirstVariableDictionaryJoined $firstVariableDictionaryJoined): void
    {
        $this->writeLine("INSERT INTO first_variable_dictionary_joined (id, value) VALUES (" . $firstVariableDictionaryJoined->id() . ",'" . $firstVariableDictionaryJoined->name() . "');");
    }
}