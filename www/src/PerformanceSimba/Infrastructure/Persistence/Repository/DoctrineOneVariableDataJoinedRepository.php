<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableDataJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataJoinedRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineOneVariableDataJoinedRepository extends EntityRepository implements OneVariableDataJoinedRepository
{
    private const BATCH_SIZE = 20;

    public function allOneVariableDataJoined(): array
    {
        return $this->findAll();
    }

    public function save(OneVariableDataJoined $oneVariableDataJoined): void
    {
        $this->getEntityManager()->persist($oneVariableDataJoined);
        $this->getEntityManager()->flush();
    }

    public function saveMultiple(array $arrayOneVariableDataJoined): void
    {
        array_map(array($this, "saveBatch"), array_chunk($arrayOneVariableDataJoined, self::BATCH_SIZE));
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableDataJoined')->execute();
    }

    private function saveBatch(array $arrayFirstVariablesDictionaryJoined): void
    {
        array_map(array($this, "saveElement"), $arrayFirstVariablesDictionaryJoined);
        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
    }

    private function saveElement(OneVariableDataJoined $oneVariableDataJoined): void
    {
        $this->getEntityManager()->persist($oneVariableDataJoined);
    }
}