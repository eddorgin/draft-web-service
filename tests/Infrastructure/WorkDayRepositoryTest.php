<?php

namespace App\Tests\Infrastructure;

use App\DDD\Domain\Entity\EntityId;
use App\DDD\Infrastructure\Persistence\InMemory\InMemoryPersistence;
use App\WorkDay\Domain\Model\WorkDayStatus;
use App\WorkDay\Infrastructure\Domain\WorkDayRepository;
use PHPUnit\Framework\TestCase;

class WorkDayRepositoryTest extends TestCase
{
    /**
     * @var WorkDayRepository
     */
    private WorkDayRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new WorkDayRepository(new InMemoryPersistence());
    }

    public function testCanGenerateId()
    {
        $this->assertEquals(1, $this->repository->generateId());
    }

    public function testThrowsExceptionWhenTryingToFindWorkTimeWhichDoesNotExist()
    {
        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage('Post with id 42 does not exist');

        $this->repository->findById(new EntityId(42));
    }

    public function testCanPersistWorkTimeDraft()
    {
        $workTimeId = $this->repository->generateId();
        $workTime = WorkDay::startWork($workTimeId);
        $this->repository->save($workTime);

        $this->repository->findById($workTimeId);

        $this->assertEquals($workTimeId, $this->repository->findById($workTimeId)->getId());
        $this->assertEquals(WorkDayStatus::STATE_ACTIVE, $workTime->getStatus()->toString());
    }
}