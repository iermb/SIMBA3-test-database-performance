<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\ThirdVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThirdVariableDictionaryJoinedRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineThirdVariableDictionaryJoinedRepository extends EntityRepository implements
    ThirdVariableDictionaryJoinedRepository
{
    private const BATCH_SIZE = 20;

    public function save(ThirdVariableDictionaryJoined $thirdVariableDictionaryJoined): void
    {
        $this->getEntityManager()->persist($thirdVariableDictionaryJoined);
        $this->getEntityManager()->flush();
    }

    public function saveMultiple(array $arrayThirdVariableDictionaryJoined): void
    {
        array_map(array($this, "saveBatch"), array_chunk($arrayThirdVariableDictionaryJoined, self::BATCH_SIZE));
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\ThirdVariableDictionaryJoined')->execute();
    }

    private function saveBatch(array $arrayThirdVariablesDictionaryJoined): void
    {
        array_map(array($this, "saveElement"), $arrayThirdVariablesDictionaryJoined);
        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
    }

    private function saveElement(ThirdVariableDictionaryJoined $thirdVariableDictionaryJoined): void
    {
        $this->getEntityManager()->persist($thirdVariableDictionaryJoined);
    }
}