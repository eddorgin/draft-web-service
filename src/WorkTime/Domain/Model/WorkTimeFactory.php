<?php


use App\DDD\Domain\Entity\EntityFactory;
use App\DDD\Domain\Entity\EntityId;

class WorkTimeFactory extends EntityFactory
{
    /**
     * @param EntityId $entityId
     * @return mixed|WorkTime
     * @throws Exception
     */
    public static function createEntity(EntityId $entityId)
    {
        return new WorkTime(
            new EntityId(),
            new \DateTimeImmutable()
        );
    }
}