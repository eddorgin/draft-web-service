<?php

namespace App\DDD\Domain\Entity;

/**
 * Class EntityId
 * @package App\DDD\Domain\Entity
 */
class EntityId
{
    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id
     */
    public function __construct($id = null)
    {
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param EntityId $userId
     * @return bool
     */
    public function equals(EntityId $userId)
    {
        return $this->getId() === $userId->getId();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getId();
    }
}