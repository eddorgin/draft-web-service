<?php


namespace App\WorkDay\Infrastructure\Persistence\Doctrine;

use App\DDD\Domain\Entity\EntityId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

/**
 * Class WorkDayId
 * @package App\WorkDay\Infrastructure\Persistence\Doctrine
 */
class WorkDayId extends GuidType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'WorkDayId';
    }

    /**
     * @param EntityId $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getId();
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return EntityId|mixed
     * @throws \Exception
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new EntityId($value);
    }
}