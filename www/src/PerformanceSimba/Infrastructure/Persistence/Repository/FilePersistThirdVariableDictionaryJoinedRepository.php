<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\ThirdVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThirdVariableDictionaryJoinedRepository;

class FilePersistThirdVariableDictionaryJoinedRepository extends FileRepository implements ThirdVariableDictionaryJoinedRepository
{
    private const FILENAME_THIRD_VARIABLE_DICTIONARY_JOINED = "../upload/importThirdVariableDictionaryJoinedRepository";

    public function __construct()
    {
        parent::__construct(self::FILENAME_THIRD_VARIABLE_DICTIONARY_JOINED);
    }

    public function save(ThirdVariableDictionaryJoined $thirdVariableDictionaryJoined): void
    {
        $this->saveQuery($thirdVariableDictionaryJoined);
    }

    public function saveMultiple(array $arrayThirdVariableDictionaryJoined): void
    {
        array_map(array($this, "saveQuery"), $arrayThirdVariableDictionaryJoined);
    }

    public function clean(): void
    {
        return;
    }

    private function saveQuery(ThirdVariableDictionaryJoined $thirdVariableDictionaryJoined): void
    {
        $this->writeLine("INSERT INTO third_variable_dictionary_joined (id, value) VALUES (" . $thirdVariableDictionaryJoined->id() . ",'" . $thirdVariableDictionaryJoined->name() . "');");
    }
}