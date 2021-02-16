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

    public function saveMultiple(array $arrayOneVariableData): void
    {
        $batchSize = 20;
        $numElement = 0;

        foreach($arrayOneVariableData as $oneVariableDictionary) {

            $this->getEntityManager()->persist($oneVariableDictionary);
            $numElement++;

            if($numElement >= $batchSize) {
                $this->getEntityManager()->flush();
                $this->getEntityManager()->clear(OneVariableData::class);
                $numElement = 0;
            }
        }

        $this->getEntityManager()->flush();
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\OneVariableData')->execute();
    }

    public function allOneVariableData(): array
    {
        return $this->findAll();
    }
}