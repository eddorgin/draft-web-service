<?php

namespace App\Tests\Infrastructure;

use App\DDD\Domain\Entity\EntityId;
use App\DDD\Infrastructure\Persistence\InMemory\InMemoryPersistence;
use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Domain\Model\WorkDayStatus;
use App\WorkDay\Infrastructure\Domain\WorkDayRepository;
use PHPUnit\Framework\TestCase;

/**
 * Class WorkDayRepositoryTest
 * @package App\Tests\Infrastructure
 */
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

    /**
     * @throws \Exception
     */
    public function testCanPersistWorkTimeDraft()
    {
        $workDayId = $this->repository->generateId();
        $workDay = new WorkDay($workDayId);
        $workTime = $workDay->startWork();
        $this->repository->save($workTime);

        $workDay = $this->repository->findById($workDayId);

        $this->assertEquals($workDayId, $workDay->getId());
        $this->assertEquals(WorkDayStatus::STATE_ACTIVE, $workDay->getStatus()->toString());
    }
}