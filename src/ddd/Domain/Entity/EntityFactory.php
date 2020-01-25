<?php

/**
 * Class EntityFactory
 */
abstract class EntityFactory
{
    /**
     * @param EntityId $entityId
     * @return mixed
     */
    abstract public function createEntity(EntityId $entityId);
}