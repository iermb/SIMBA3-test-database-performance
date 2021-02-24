<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\SecondVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Repository\SecondVariableDictionaryRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineSecondVariableDictionaryRepository extends EntityRepository implements SecondVariableDictionaryRepository
{
    private const BATCH_SIZE = 200;

    public function secondVariableDictionaryByIds(array $ids): array
    {
        return $this->findBy([
            'id' => $ids,
        ]);
    }

    public function save(SecondVariableDictionary $secondVariableDictionary): void
    {
        $this->getEntityManager()->persist($secondVariableDictionary);
        $this->getEntityManager()->flush();
    }

    public function saveMultiple(array $arraySecondVariableDictionary): void
    {
        array_map(array($this, "saveBatch"), array_chunk($arraySecondVariableDictionary, self::BATCH_SIZE));
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\SecondVariableDictionary')->execute();
    }

    public function allSecondVariableDictionary(): array
    {
        return $this->findAll();
    }

    private function saveBatch(array $arraySecondVariablesDictionaryJoined): void
    {
        array_map(array($this, "saveElement"), $arraySecondVariablesDictionaryJoined);
        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
    }

    private function saveElement(SecondVariableDictionary $secondVariableDictionary): void
    {
        $this->getEntityManager()->persist($secondVariableDictionary);
    }
}