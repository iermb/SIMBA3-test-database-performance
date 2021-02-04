<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineFirstVariableDictionaryRepository extends EntityRepository implements FirstVariableDictionaryRepository
{
    public function save(FirstVariableDictionary $firstVariableDictionary): void
    {
        $this->getEntityManager()->persist($firstVariableDictionary);
        $this->getEntityManager()->flush();
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM :entity ;')->setParameter('entity',
            $this->getClassName())->execute();
    }
}