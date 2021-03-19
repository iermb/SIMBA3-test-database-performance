<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\ThreeVariableData;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThreeVariableDataRepository;

class FilePersistThreeVariableDataRepository extends FileRepository implements ThreeVariableDataRepository
{
    private const FILENAME_THREE_VARIABLE_DATA = "../upload/importThreeVariableDataRepository";

    private ThreeVariableDataRepository $threeVariableDataRepository;

    public function __construct(ThreeVariableDataRepository $threeVariableDataRepository)
    {
        parent::__construct(self::FILENAME_THREE_VARIABLE_DATA);
        $this->threeVariableDataRepository = $threeVariableDataRepository;
    }


    public function setIds1(array $ids1): void
    {
        return;
    }

    public function setIds2(array $ids2): void
    {
        return;
    }

    public function setIds3(array $ids3): void
    {
        return;
    }

    public function threeVariableDataByIds(): array
    {
        return $this->threeVariableDataRepository->threeVariableDataByIds();
    }

    public function save(ThreeVariableData $threeVariableData): void
    {
        $this->saveQuery($threeVariableData);
    }

    public function saveMultiple(array $arrayThreeVariableData): void
    {
        array_map(array($this, "saveQuery"), $arrayThreeVariableData);
    }

    public function clean(): void
    {
        return;
    }

    public function allThreeVariableData(): array
    {
        $this->threeVariableDataRepository->allThreeVariableData();
    }

    private function saveQuery(ThreeVariableData $threeVariableData): void
    {
        $this->writeLine("INSERT INTO three_variable_data (variable_first_id, variable_second_id, variable_third_id, value) VALUES (" . $threeVariableData->variableFirstId() . "," . $threeVariableData->variableSecondId() . "," . $threeVariableData->variableThirdId() . "," . $threeVariableData->variableThirdId() . ");");
    }
}