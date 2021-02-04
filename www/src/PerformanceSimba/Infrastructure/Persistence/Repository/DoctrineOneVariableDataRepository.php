<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableData;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineOneVariableDataRepository extends EntityRepository implements OneVariableDataRepository
{

    public function save(OneVariableData $oneVariableData): void
    {
        $this->getEntityManager()->persist($oneVariableData);
        $this->getEntityManager()->flush();
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM :entity ;')->setParameter('entity',
            $this->getClassName())->execute();
    }
}