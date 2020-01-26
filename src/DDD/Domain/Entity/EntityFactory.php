<?php

namespace App\DDD\Domain\Entity;

/**
 * Class EntityFactory
 * @package App\DDD\Domain\Entity
 */
abstract class EntityFactory
{
    /**
     * @param array $data
     * @return mixed
     */
    abstract public static function createEntityFromArray(array $data);
}