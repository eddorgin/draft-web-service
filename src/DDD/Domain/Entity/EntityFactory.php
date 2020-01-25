<?php

namespace App\DDD\Domain\Entity;

/**
 * Class EntityFactory
 * @package App\DDD\Domain\Entity
 */
abstract class EntityFactory
{
    /**
     * @param EntityId $entityId
     * @return mixed
     */
    abstract public static function createEntity(EntityId $entityId);
}