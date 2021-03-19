<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Entity\ThirdVariableDictionary;
use App\PerformanceSimba\Domain\DataDictionary\Repository\ThirdVariableDictionaryRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineThirdVariableDictionaryRepository extends EntityRepository implements ThirdVariableDictionaryRepository
{
    private const BATCH_SIZE = 200;

    public function thirdVariableDictionaryByIds(array $ids): array
    {
        return $this->findBy([
            'id' => $ids,
        ]);
    }

    public function save(ThirdVariableDictionary $thirdVariableDictionary): void
    {
        $this->getEntityManager()->persist($thirdVariableDictionary);
        $this->getEntityManager()->flush();
    }

    public function saveMultiple(array $arrayThirdVariableDictionary): void
    {
        array_map(array($this, "saveBatch"), array_chunk($arrayThirdVariableDictionary, self::BATCH_SIZE));
    }

    public function clean(): void
    {
        $this->getEntityManager()->createQuery('DELETE FROM App\PerformanceSimba\Domain\DataDictionary\Entity\ThirdVariableDictionary')->execute();
    }

    public function allThirdVariableDictionary(): array
    {
        return $this->findAll();
    }

    private function saveBatch(array $arrayThirdVariablesDictionaryJoined): void
    {
        array_map(array($this, "saveElement"), $arrayThirdVariablesDictionaryJoined);
        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
    }

    private function saveElement(ThirdVariableDictionary $thirdVariableDictionary): void
    {
        $this->getEntityManager()->persist($thirdVariableDictionary);
    }
}