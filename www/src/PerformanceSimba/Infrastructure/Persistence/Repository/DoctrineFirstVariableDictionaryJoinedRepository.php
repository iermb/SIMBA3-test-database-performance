<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryJoinedRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineFirstVariableDictionaryJoinedRepository extends EntityRepository implements
    FirstVariableDictionaryJoinedRepository
{
    private const BATCH_SIZE = 20;

    public function save(FirstVariableDictionaryJoined $firstVariableDictionaryJoined): void
    {
        $this->getEntityManager()->persist($firstVariableDictionaryJoined);
        $this->getEntityManager()->flush();
    }

    public function saveMultiple(array $arrayFirstVariableDictionaryJoined): void
    {
        array_map(array($this, "saveBatch"), array_chunk($arrayFirstVariableDictionaryJoined, self::BATCH_SIZE));
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionaryJoined')->execute();
    }

    private function saveBatch(array $arrayFirstVariablesDictionaryJoined): void
    {
        array_map(array($this, "saveElement"), $arrayFirstVariablesDictionaryJoined);
        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
    }

    private function saveElement(FirstVariableDictionaryJoined $firstVariableDictionaryJoined): void
    {
        $this->getEntityManager()->persist($firstVariableDictionaryJoined);
    }
}