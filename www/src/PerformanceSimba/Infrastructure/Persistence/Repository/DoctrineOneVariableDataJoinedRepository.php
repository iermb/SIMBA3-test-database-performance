<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


use App\PerformanceSimba\Domain\DataDictionary\Repository\OneVariableDataJoinedRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineOneVariableDataJoinedRepository extends EntityRepository implements OneVariableDataJoinedRepository
{

    public function allOneVariableDataJoined(): array
    {
        return $this->findAll();
    }
}