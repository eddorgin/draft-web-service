<?php

/**
 * Class EntityStatus
 */
abstract class EntityStatus
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * EntityStatus constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @param int $status
     */
    protected static function ensureIsValidId(int $status)
    {
        if (!in_array($status, array_keys(self::getValidStates()), true)) {
            throw new InvalidArgumentException('Invalid status id given');
        }
    }

    /**
     * @param string $status
     */
    protected static function ensureIsValidName(string $status)
    {
        if (!in_array($status, self::getValidStates(), true)) {
            throw new InvalidArgumentException('Invalid status name given');
        }
    }

    public function toInt(): int
    {
        return $this->id;
    }

    /**
     * there is a reason that I avoid using __toString() as it operates outside of the stack in PHP
     * and is therefor not able to operate well with exceptions
     */
    public function toString(): string
    {
        return $this->name;
    }

    /**
     * @param int $statusId
     * @return mixed
     */
    public static abstract function fromInt(int $statusId);

    /**
     * @param string $status
     * @return mixed
     */
    public static abstract function fromString(string $status);

    /**
     * @return array
     */
    protected static abstract function getValidStates();
}