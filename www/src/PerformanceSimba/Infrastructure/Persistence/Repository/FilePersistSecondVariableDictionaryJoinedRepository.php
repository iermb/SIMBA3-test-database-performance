<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\SecondVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\SecondVariableDictionaryJoinedRepository;

class FilePersistSecondVariableDictionaryJoinedRepository extends FileRepository implements
    SecondVariableDictionaryJoinedRepository
{
    private const FILENAME_SECOND_VARIABLE_DICTIONARY_JOINED = "../upload/importSecondVariableDictionaryJoinedRepository";

    public function __construct()
    {
        parent::__construct(self::FILENAME_SECOND_VARIABLE_DICTIONARY_JOINED);
    }

    public function save(SecondVariableDictionaryJoined $secondVariableDictionaryJoined): void
    {
        $this->saveQuery($secondVariableDictionaryJoined);
    }

    public function saveMultiple(array $arraySecondVariableDictionaryJoined): void
    {
        array_map(array($this, "saveQuery"), $arraySecondVariableDictionaryJoined);
    }

    public function clean(): void
    {
        return;
    }

    private function saveQuery(SecondVariableDictionaryJoined $secondVariableDictionaryJoined): void
    {
        $this->writeLine("INSERT INTO second_variable_dictionary_joined (id, value) VALUES (" . $secondVariableDictionaryJoined->id() . ",'" . $secondVariableDictionaryJoined->name() . "');");
    }
}