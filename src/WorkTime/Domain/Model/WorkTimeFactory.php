<?php


class WorkTimeFactory extends EntityFactory
{
    /**
     * @param EntityId $entityId
     * @return mixed|WorkTime
     * @throws Exception
     */
    public function createEntity(EntityId $entityId)
    {
        return new WorkTime(
            new EntityId(),
            new \DateTimeImmutable()
        );
    }
}