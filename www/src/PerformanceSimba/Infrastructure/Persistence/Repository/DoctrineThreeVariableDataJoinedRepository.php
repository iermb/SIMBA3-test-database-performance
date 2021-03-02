<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\ThreeVariableDataJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThreeVariableDataJoinedRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineThreeVariableDataJoinedRepository extends EntityRepository implements ThreeVariableDataJoinedRepository
{
    private const BATCH_SIZE = 20;

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

    public function threeVariableDataJoinedByIds(): array
    {
        return $this->findBy([
            'firstVariableDictionaryJoined' => $this->ids1,
            'secondVariableDictionaryJoined' => $this->ids2,
            'thirdVariableDictionaryJoined' => $this->ids3,
        ]);
    }

    public function allThreeVariableDataJoined(): array
    {
        return $this->findAll();
    }

    public function save(ThreeVariableDataJoined $threeVariableDataJoined): void
    {
        $this->getEntityManager()->persist($threeVariableDataJoined);
        $this->getEntityManager()->flush();
    }

    public function saveMultiple(array $arrayThreeVariableDataJoined): void
    {
        array_map(array($this, "saveBatch"), array_chunk($arrayThreeVariableDataJoined, self::BATCH_SIZE));
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\ThreeVariableDataJoined')->execute();
    }

    private function saveBatch(array $arrayFirstVariablesDictionaryJoined): void
    {
        array_map(array($this, "saveElement"), $arrayFirstVariablesDictionaryJoined);
        $this->getEntityManager()->flush();
    }

    private function saveElement(ThreeVariableDataJoined $threeVariableDataJoined): void
    {
        $this->getEntityManager()->persist($threeVariableDataJoined);
    }
}