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

    public function saveMultiple(array $arrayFirstVariableDictionaryJoined): void
    {
        $batchSize = 20;
        $numElement = 0;

        foreach($arrayFirstVariableDictionaryJoined as $firstVariableDictionary) {

            $this->getEntityManager()->persist($firstVariableDictionary);
            $numElement++;

            if($numElement >= $batchSize) {
                $this->getEntityManager()->flush();
                $this->getEntityManager()->clear(FirstVariableDictionaryJoined::class);
                $numElement = 0;
            }
        }

        $this->getEntityManager()->flush();
    }


    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionaryJoined')->execute();
    }
}