<?php

namespace App\DDD\Domain\Entity;

/**
 * Class EntityFactory
 * @package App\DDD\Domain\Entity
 */
abstract class EntityFactory
{
    /**
     * @param EntityDto $entityDto
     * @return mixed
     */
    abstract public static function recoverEntityFromDto(EntityDto $entityDto);
}