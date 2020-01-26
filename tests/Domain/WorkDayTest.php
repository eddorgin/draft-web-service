<?php

namespace App\Tests\Domain;

use App\DDD\Domain\DomainEventPublisher;
use App\DDD\Domain\Entity\EntityId;
use App\WorkDay\Domain\Event\WorkDayStarted;
use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Domain\WorkDayEventPublisher;
use App\WorkDay\Infrastructure\Application\Test\TestSubscriber;
use PHPUnit\Framework\TestCase;

class WorkDayTest extends TestCase
{
    private $testSubscriber;

    protected function setUp(): void
    {
        $this->testSubscriber = new TestSubscriber();
    }

    /**
     * @throws \Exception
     */
    public function testPublishWorkDayStartedEvent()
    {
        $id = WorkDayEventPublisher::instance()->subscribe($this->testSubscriber);
        $workDay = new WorkDay(new EntityId(), new \DateTimeImmutable());
        $workDay->start
        WorkDayEventPublisher::instance()->unsubscribe($id);

        $this->assertInstanceOf(WorkDayStarted::class, $this->testSubscriber->domainEvent);
        $this->assertEquals($workDay->startDateTime, $this->testSubscriber->domainEvent->getOccurredOn());
    }

    public function testPublishWorkDayPausedEvent()
    {
        $id = WorkDayEventPublisher::instance()->subscribe($this->testSubscriber);
        $workDay = new WorkDay(new EntityId(), new \DateTimeImmutable());

    }
}