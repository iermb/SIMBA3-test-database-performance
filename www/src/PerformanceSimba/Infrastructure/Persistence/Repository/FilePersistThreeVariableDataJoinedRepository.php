<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\ThreeVariableDataJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThreeVariableDataJoinedRepository;

class FilePersistThreeVariableDataJoinedRepository extends FileRepository implements ThreeVariableDataJoinedRepository
{
    private const FILENAME_THREE_VARIABLE_DATA_JOINED = "../upload/importThreeVariableDataJoinedRepository";

    private ThreeVariableDataJoinedRepository $threeVariableDataJoinedRepository;

    public function __construct(ThreeVariableDataJoinedRepository $threeVariableDataJoinedRepository)
    {
        parent::__construct(self::FILENAME_THREE_VARIABLE_DATA_JOINED);
        $this->threeVariableDataJoinedRepository = $threeVariableDataJoinedRepository;
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

    public function threeVariableDataJoinedByIds(): array
    {
        return array();
    }

    public function allThreeVariableDataJoined(): array
    {
        return $this->threeVariableDataJoinedRepository->allThreeVariableDataJoined();
    }

    public function save(ThreeVariableDataJoined $threeVariableDataJoined): void
    {
        $this->saveQuery($threeVariableDataJoined);
    }

    public function saveMultiple(array $arrayThreeVariableDataJoined): void
    {
        array_map(array($this, 'saveQuery'), $arrayThreeVariableDataJoined);
    }

    public function clean(): void
    {
        return;
    }

    private function saveQuery(ThreeVariableDataJoined $threeVariableDataJoined): void
    {
        $this->writeLine('INSERT INTO three_variable_data_joined (variable_first_id, variable_second_id, variable_third_id, value) VALUES (' . $threeVariableDataJoined->firstVariableDictionaryJoined()->id() . ',' . $threeVariableDataJoined->secondVariableDictionaryJoined()->id() . ',' . $threeVariableDataJoined->thirdVariableDictionaryJoined()->id() . ',' . $threeVariableDataJoined->value() . ');');
    }
}