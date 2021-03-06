<?php

namespace App\DDD\Domain\Entity;

use Ramsey\Uuid\Uuid;

/**
 * Class EntityId
 * @package App\DDD\Domain\Entity
 */
class EntityId
{
    /**
     * @var mixed
     */
    private $id;

    /**
     * EntityId constructor.
     * @param null $id
     * @throws \Exception
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
        return '' . $this->getId();
    }
}