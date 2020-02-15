<?php


namespace App\WorkDay\Infrastructure\Persistence\Doctrine;


use App\DDD\Application\Persistence;
use App\WorkDay\Domain\Model\WorkDay;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;

/**
 * Class DoctrinePersistence
 * @package App\WorkDay\Infrastructure\Persistence\Doctrine
 */
class DoctrinePersistence implements Persistence
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * DoctrinePersistence constructor.
     * @param Connection $connection
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\ORMException
     */
    public function __construct(Connection $connection)
    {
        $factory = new EntityManagerFactory();
        $this->entityManager = $factory->build($connection);
    }

    /**
     * @return int
     */
    public function generateId()
    {
        return null;
    }

    /**
     * @param $data
     * @return mixed|void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function persist($data)
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush($data);
    }

    /**
     * @param int $id
     * @return mixed|object|null
     * @throws ORMException
     * @throw OptimisticLockException
     * @throws TransactionRequiredException
     */
    public function retrieve(int $id)
    {
        return $this->entityManager->find(WorkDay::class, $id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->delete('WorkDay', 'w')
             ->where('w.id = :workday_id')
             ->setParameter('workday_id', $id);

        return $queryBuilder->getQuery()->execute();
    }
}