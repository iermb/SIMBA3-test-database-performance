<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\SecondVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\SecondVariableDictionaryJoinedRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineSecondVariableDictionaryJoinedRepository extends EntityRepository implements
    SecondVariableDictionaryJoinedRepository
{
    private const BATCH_SIZE = 20;

    public function save(SecondVariableDictionaryJoined $secondVariableDictionaryJoined): void
    {
        $this->getEntityManager()->persist($secondVariableDictionaryJoined);
        $this->getEntityManager()->flush();
    }

    public function saveMultiple(array $arraySecondVariableDictionaryJoined): void
    {
        array_map(array($this, "saveBatch"), array_chunk($arraySecondVariableDictionaryJoined, self::BATCH_SIZE));
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\SecondVariableDictionaryJoined')->execute();
    }

    private function saveBatch(array $arraySecondVariablesDictionaryJoined): void
    {
        array_map(array($this, "saveElement"), $arraySecondVariablesDictionaryJoined);
        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
    }

    private function saveElement(SecondVariableDictionaryJoined $secondVariableDictionaryJoined): void
    {
        $this->getEntityManager()->persist($secondVariableDictionaryJoined);
    }
}