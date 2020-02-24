<?php


namespace App\WorkDay\Infrastructure\Persistence\Doctrine;


use App\DDD\Domain\Entity\EntityId;
use App\DDD\Domain\Event\LoggedEvent;
use Doctrine\DBAL\Connection;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

/**
 * Class DoctrineLogHandler
 * @package App\WorkDay\Infrastructure\Persistence\Doctrine
 */
class DoctrineLogHandler extends AbstractProcessingHandler
{
    private $entityManager;

    /**
     * DoctrineLogHandler constructor.
     * @param Connection $connection
     * @param int $level
     * @param bool $bubble
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\ORMException
     */
    public function __construct(Connection $connection, $level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
        $factory = new EntityManagerFactory();
        $this->entityManager = $factory->build($connection);
    }

    /**
     * Writes the record down to the log of the implementing handler
     * @param array $record
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function write(array $record): void
    {
        $loggedEvent = new LoggedEvent(
            new EntityId(),
            $record,
            new \DateTimeImmutable()
        );
        $this->entityManager->persist($loggedEvent);
        $this->entityManager->flush();
    }
}