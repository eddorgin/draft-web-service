<?php

namespace App\WorkDay\Domain\Model;

use App\DDD\Domain\Entity\EntityStatus;

/**
 * Class WorkDayStatus
 * @package App\WorkDay\Domain\Model
 */
class WorkDayStatus extends EntityStatus
{
    const STATE_ACTIVE_ID = 1;
    const STATE_FINISHED_ID = 2;
    const STATE_PAUSED_ID = 3;

    const STATE_ACTIVE = 'active';
    const STATE_FINISHED = 'finished';
    const STATE_PAUSED = 'paused';

    /**
     * @var array
     */
    private static array $validStates = [
        self::STATE_ACTIVE_ID => self::STATE_ACTIVE,
        self::STATE_FINISHED_ID => self::STATE_FINISHED,
        self::STATE_PAUSED => self::STATE_PAUSED
    ];

    /**
     * @return array
     */
    protected static function getValidStates()
    {
        return self::$validStates;
    }

    /**
     * @param int $statusId
     * @return mixed
     */
    public static function fromInt(int $statusId)
    {
        self::ensureIsValidId($statusId);

        return new self($statusId, self::$validStates[$statusId]);
    }

    /**
     * @param string $status
     * @return mixed
     */
    public static function fromString(string $status)
    {
        self::ensureIsValidName($status);
        $state = array_search($status, self::$validStates);

        if ($state === false) {
            throw new \InvalidArgumentException('Invalid state given!');
        }

        return new self($state, $status);
    }
}