<?php


use PHPUnit\Framework\TestCase;

class PostRepositoryTest extends TestCase
{
    /**
     * @var WorkTimeRepository
     */
    private WorkTimeRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new WorkTimeRepository(new InMemoryPersistence());
    }

    public function testCanGenerateId()
    {
        $this->assertEquals(1, $this->repository->generateId());
    }

    public function testThrowsExceptionWhenTryingToFindWorkTimeWhichDoesNotExist()
    {
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage('Post with id 42 does not exist');

        $this->repository->findById(new EntityId(42));
    }

    public function testCanPersistWorkTimeDraft()
    {
        $workTimeId = $this->repository->generateId();
        $workTime = WorkTime::startWork($workTimeId);
        $this->repository->save($workTime);

        $this->repository->findById($workTimeId);

        $this->assertEquals($workTimeId, $this->repository->findById($workTimeId)->getId());
        $this->assertEquals(WorkTimeStatus::STATE_ACTIVE, $workTime->getStatus()->toString());
    }
}