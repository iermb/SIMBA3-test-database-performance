<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\ThreeVariableData;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThreeVariableDataRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineThreeVariableDataRepository extends EntityRepository implements ThreeVariableDataRepository
{
    private const BATCH_SIZE = 200;

    private array $ids1 = [];
    private array $ids2 = [];
    private array $ids3 = [];

    public function setIds1(array $ids1): void {
        $this->ids1 = $ids1;
    }

    public function setIds2(array $ids2): void {
        $this->ids2 = $ids2;
    }

    public function setIds3(array $ids3): void {
        $this->ids3 = $ids3;
    }

    public function threeVariableDataByIds(): array
    {
        return $this->findBy([
            'variableFirstId' => $this->ids1,
            'variableSecondId' => $this->ids2,
            'variableThirdId' => $this->ids3,
        ]);
    }

    public function save(ThreeVariableData $threeVariableData): void
    {
        $this->getEntityManager()->persist($threeVariableData);
        $this->getEntityManager()->flush();
    }

    public function saveMultiple(array $arrayThreeVariableData): void
    {
        array_map(array($this, "saveBatch"), array_chunk($arrayThreeVariableData, self::BATCH_SIZE));
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\ThreeVariableData')->execute();
    }

    public function allThreeVariableData(): array
    {
        return $this->findAll();
    }

    private function saveBatch(array $arrayThreeVariableData): void
    {
        array_map(array($this, "saveElement"), $arrayThreeVariableData);
        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
    }

    private function saveElement(ThreeVariableData $threeVariableData): void
    {
        $this->getEntityManager()->persist($threeVariableData);
    }
}