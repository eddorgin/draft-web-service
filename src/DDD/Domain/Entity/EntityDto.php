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
    abstract function getFetchedEntity();

    /**
     * @return array
     */
    abstract function getFetchedExternalData();
}