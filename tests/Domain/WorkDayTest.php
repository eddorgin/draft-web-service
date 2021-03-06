<?php

namespace App\Tests\Domain;

use App\DDD\Domain\Entity\EntityId;
use App\DDD\Domain\Event\DomainEvent;
use App\Tests\TestCaseWrapper;
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
class WorkDayTest extends TestCaseWrapper
{
    /**
     * @var TestSubscriber
     */
    protected $subscriber;

    protected function setUp(): void
    {
        $this->subscriber = new TestSubscriber();
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
    public function testTimeSpentAfterPause()
    {
        $workDay = $this->getWorkDay();
        $workDay->startWork();
        sleep(1);
        $workDay->pauseWork();

        $this->assertEquals(1, $workDay->getTimeSpent());
    }

    /**
     * @throws \Exception
     */
    public function testTimeSpentAfterResume()
    {
        $workDay = $this->getWorkDay();
        $workDay->startWork();
        sleep(1);
        $workDay->pauseWork();
        sleep(1);
        $workDay->resumeWork();

        $this->assertEquals(1, $workDay->getTimeSpent());
    }

    /**
     * @throws \Exception
     */
    public function testTimeSpentAfterFinish()
    {
        $workDay = $this->getWorkDay();
        $workDay->startWork();
        sleep(1);
        $workDay->pauseWork();
        sleep(1);
        $workDay->resumeWork();
        sleep(1);
        $workDay->finishWork();

        $this->assertEquals(2, $workDay->getTimeSpent());
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
        $this->assertInstanceOf($event, $this->subscriber->domainEvent);
        $this->assertEquals($workDay->status->toString(), $this->getSubscriber()->domainEvent->getStatus());
    }

    /**
     * @return TestSubscriber
     */
    private function getSubscriber()
    {
        return $this->subscriber;
    }
}