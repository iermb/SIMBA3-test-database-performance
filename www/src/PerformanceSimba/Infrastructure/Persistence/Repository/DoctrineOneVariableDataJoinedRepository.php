<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableDataJoined;
use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataJoinedRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineOneVariableDataJoinedRepository extends EntityRepository implements OneVariableDataJoinedRepository
{

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
        $batchSize = 20;
        $numElement = 0;

        foreach($arrayOneVariableDataJoined as $oneVariableDictionary) {

            $this->getEntityManager()->persist($oneVariableDictionary);
            $numElement++;

            if($numElement >= $batchSize) {
                $this->getEntityManager()->flush();
                $this->getEntityManager()->clear(OneVariableDataJoined::class);
                $numElement = 0;
            }
        }

        $this->getEntityManager()->flush();
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableDataJoined')->execute();
    }
}