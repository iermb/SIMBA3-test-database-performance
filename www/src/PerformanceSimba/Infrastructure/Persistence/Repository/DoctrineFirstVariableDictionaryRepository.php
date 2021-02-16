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

    public function saveMultiple(array $arrayFirstVariableDictionary): void
    {
        $batchSize = 20;
        $numElement = 0;

        foreach($arrayFirstVariableDictionary as $firstVariableDictionary) {

            $this->getEntityManager()->persist($firstVariableDictionary);
            $numElement++;

            if($numElement >= $batchSize) {
                $this->getEntityManager()->flush();
                $this->getEntityManager()->clear(FirstVariableDictionary::class);
                $numElement = 0;
            }
        }

        $this->getEntityManager()->flush();
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary')->execute();
    }

    public function allFirstVariableDictionary(): array
    {
        return $this->findAll();
    }
}