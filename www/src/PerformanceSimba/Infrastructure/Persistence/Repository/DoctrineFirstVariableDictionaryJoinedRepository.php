<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionaryJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryJoinedRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineFirstVariableDictionaryJoinedRepository extends EntityRepository implements
    FirstVariableDictionaryJoinedRepository
{

    public function save(FirstVariableDictionaryJoined $firstVariableDictionaryJoined): void
    {
        $this->getEntityManager()->persist($firstVariableDictionaryJoined);
        $this->getEntityManager()->flush();
    }


    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionaryJoined')->execute();
    }
}