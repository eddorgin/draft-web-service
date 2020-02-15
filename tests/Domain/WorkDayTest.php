<?php

namespace App\Tests\Domain;

use App\DDD\Domain\Entity\EntityId;
use App\DDD\Domain\Event\DomainEvent;
use App\WorkDay\Domain\Event\WorkDayFinished;
use App\WorkDay\Domain\Event\WorkDayPaused;
use App\WorkDay\Domain\Event\WorkDayResumed;
use App\WorkDay\Domain\Event\WorkDayStarted;
use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Domain\WorkDayEventPublisher;
use App\WorkDay\Infrastructure\Application\Test\TestSubscriber;
use PHPUnit\Framework\TestCase;

/**
 * Class WorkDayTest
 * @package App\Tests\Domain
 */
class WorkDayTest extends TestCase
{
    /**
     * @var TestSubscriber
     */
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
        $id = $this->getSubscribeId();
        $workDay = $this->getWorkDay();
        $workDay->startWork();
        WorkDayEventPublisher::instance()->unsubscribe($id);

        $this->assertEvent($workDay, WorkDayStarted::class);
    }

    /**
     * @throws \Exception
     */
    public function testPublishWorkDayPausedEvent()
    {
        $id = $this->getSubscribeId();
        $workDay = $this->getWorkDay();
        $workDay->startWork();
        $workDay->pauseWork();
        WorkDayEventPublisher::instance()->unsubscribe($id);

        $this->assertEvent($workDay, WorkDayPaused::class);
    }

    /**
     * @throws \Exception
     */
    public function testPublishWorkDayFinishedEvent()
    {
        $id = $this->getSubscribeId();
        $workDay = $this->getWorkDay();
        $workDay->startWork();
        $workDay->finishWork();
        WorkDayEventPublisher::instance()->unsubscribe($id);

        $this->assertEvent($workDay, WorkDayFinished::class);
    }

    /**
     * @throws \Exception
     */
    public function testCanResumeWorkDayAfterPausedEvent()
    {
        $id = $this->getSubscribeId();
        $workDay = $this->getWorkDay();
        $workDay->startWork();
        $workDay->pauseWork();
        $workDay->resumeWork();

        WorkDayEventPublisher::instance()->unsubscribe($id);

        $this->assertEvent($workDay, WorkDayResumed::class);
    }

    /**
     * @param WorkDay $workDay
     * @param string $event
     */
    private function assertEvent($workDay, $event)
    {
        $this->assertInstanceOf($event, $this->testSubscriber->domainEvent);
        $this->assertEquals($workDay->status->toString(), $this->getSubscriber()->domainEvent->getStatus());
    }

    /**
     * @return WorkDay
     * @throws \Exception
     */
    private function getWorkDay()
    {
        return new WorkDay(new EntityId());
    }

    /**
     * @return TestSubscriber
     */
    private function getSubscriber()
    {
        return $this->testSubscriber;
    }

    /**
     * @return mixed
     */
    private function getSubscribeId()
    {
        return WorkDayEventPublisher::instance()->subscribe($this->testSubscriber);
    }
}