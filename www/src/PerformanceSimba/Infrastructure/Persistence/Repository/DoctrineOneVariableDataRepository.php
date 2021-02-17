<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableData;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineOneVariableDataRepository extends EntityRepository implements OneVariableDataRepository
{
    private const BATCH_SIZE = 200;

    public function save(OneVariableData $oneVariableData): void
    {
        $this->getEntityManager()->persist($oneVariableData);
        $this->getEntityManager()->flush();
    }

    public function saveMultiple(array $arrayOneVariableData): void
    {
        array_map(array($this, "saveBatch"), array_chunk($arrayOneVariableData, self::BATCH_SIZE));
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableData')->execute();
    }

    public function allOneVariableData(): array
    {
        return $this->findAll();
    }

    private function saveBatch(array $arrayFirstVariablesDictionaryJoined): void
    {
        array_map(array($this, "saveElement"), $arrayFirstVariablesDictionaryJoined);
        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
    }

    private function saveElement(OneVariableData $oneVariableData): void
    {
        $this->getEntityManager()->persist($oneVariableData);
    }
}