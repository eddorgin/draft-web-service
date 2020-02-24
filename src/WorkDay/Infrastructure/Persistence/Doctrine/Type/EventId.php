<?php


namespace App\WorkDay\Infrastructure\Persistence\Doctrine\Type;


use App\DDD\Domain\Entity\EntityId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

/**
 * Class EventId
 * @package App\WorkDay\Infrastructure\Persistence\Doctrine\Type
 */
class EventId extends GuidType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'EventId';
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
{

}