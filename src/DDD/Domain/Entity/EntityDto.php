<?php


namespace App\DDD\Domain\Entity;

/**
 * Class EntityDto
 * @package App\DDD\Domain\Entity
 */
abstract class EntityDto
{
    /**
     * @return mixed
     */
    abstract public function getFetchedEntity();

    /**
     * @return array
     */
    abstract public function getFetchedExternalData();
}