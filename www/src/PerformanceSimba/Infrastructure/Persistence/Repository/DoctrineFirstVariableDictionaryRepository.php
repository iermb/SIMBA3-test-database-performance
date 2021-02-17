<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Repository\FirstVariableDictionaryRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineFirstVariableDictionaryRepository extends EntityRepository implements FirstVariableDictionaryRepository
{
    private const BATCH_SIZE = 20;

    public function save(FirstVariableDictionary $firstVariableDictionary): void
    {
        $this->getEntityManager()->persist($firstVariableDictionary);
        $this->getEntityManager()->flush();
    }

    public function saveMultiple(array $arrayFirstVariableDictionary): void
    {
        array_map(array($this, "saveBatch"), array_chunk($arrayFirstVariableDictionary, self::BATCH_SIZE));
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\FirstVariableDictionary')->execute();
    }

    public function allFirstVariableDictionary(): array
    {
        return $this->findAll();
    }

    private function saveBatch(array $arrayFirstVariablesDictionaryJoined): void
    {
        array_map(array($this, "saveElement"), $arrayFirstVariablesDictionaryJoined);
        $this->getEntityManager()->flush();
    }

    private function saveElement(FirstVariableDictionary $firstVariableDictionary): void
    {
        $this->getEntityManager()->persist($firstVariableDictionary);
    }
}