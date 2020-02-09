<?php


namespace App\WorkDay\Infrastructure\Persistence\Doctrine;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

/**
 * Class EntityManagerFactory
 * @package App\WorkDay\Infrastructure\Persistence\Doctrine
 */
class EntityManagerFactory
{
    /**
     * @param $conn
     * @return EntityManager
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\ORMException
     */
    public function build($conn)
    {
        return EntityManager::create(
            $conn,
            Setup::createXMLMetadataConfiguration([__DIR__ . '/Mapping'], true)
        );
    }
}