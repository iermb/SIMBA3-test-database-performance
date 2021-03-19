<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\ThirdVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThirdVariableDictionaryRepository;

class FilePersistThirdVariableDictionaryRepository extends FileRepository implements ThirdVariableDictionaryRepository
{
    private const FILENAME_THIRD_VARIABLE_DICTIONARY = "../upload/importThirdVariableDictionaryRepository";

    private ThirdVariableDictionaryRepository $thirdVariableDictionaryRepository;

    public function __construct(ThirdVariableDictionaryRepository $thirdVariableDictionaryRepository)
    {
        parent::__construct(self::FILENAME_THIRD_VARIABLE_DICTIONARY);
        $this->thirdVariableDictionaryRepository = $thirdVariableDictionaryRepository;
    }

    public function thirdVariableDictionaryByIds(array $ids): array
    {
        $this->thirdVariableDictionaryRepository->thirdVariableDictionaryByIds($ids);
    }

    public function save(ThirdVariableDictionary $thirdVariableDictionary): void
    {
        $this->saveQuery($thirdVariableDictionary);
    }

    private function saveQuery(ThirdVariableDictionary $thirdVariableDictionary): void
    {
        $this->writeLine("INSERT INTO third_variable_dictionary (id, value) VALUES (" . $thirdVariableDictionary->id() . ",'" . $thirdVariableDictionary->name() . "');");
    }

    public function saveMultiple(array $arrayThirdVariableDictionary): void
    {
        array_map(array($this, "saveQuery"), $arrayThirdVariableDictionary);
    }

    public function clean(): void
    {
        return;
    }

    public function allThirdVariableDictionary(): array
    {
        return $this->thirdVariableDictionaryRepository->allThirdVariableDictionary();
    }
}