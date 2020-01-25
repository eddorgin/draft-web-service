<?php

namespace App\DDD\Domain;

use App\DDD\Domain\Entity\EntityId;

/**
 * Repository encapsulates the set of objects persisted in a data store and the operations performed over them
 * providing a more object-oriented view of the persistence layer
 *
 * Repository also supports the objective of achieving a clean separation and one-way dependency
 * between the domain and data mapping layers
 *
 * Interface DomainRepository
 */
interface DomainRepository
{
    /**
     * @return EntityId
     */
    public function generateId(): EntityId;

    /**
     * @param $entity
     * @return bool
     */
    public function save($entity): bool;
}