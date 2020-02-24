<?php


namespace App\Tests\Infrastructure;


use App\DDD\Domain\Event\LoggerDomainEventSubscriber;
use App\DDD\Infrastructure\Logging\MonologLoggerAdapter;
use App\Tests\TestCaseWrapper;
use App\WorkDay\Domain\WorkDayEventPublisher;
use Monolog\Handler\TestHandler;
use Monolog\Logger;

/**
 * Class LoggerTest
 * @package App\Tests\Infrastructure
 */
class LoggerTest extends TestCaseWrapper
{
    /**
     * @var TestHandler
     */
    private $testHandler;

    /**
     * @var LoggerDomainEventSubscriber
     */
    protected $subscriber;

    protected function setUp(): void
    {
        $this->testHandler = new TestHandler();
        $this->subscriber = new LoggerDomainEventSubscriber(
            new MonologLoggerAdapter($this->testHandler)
        );
    }

    /**
     * @throws \Exception
     */
    public function testHandlerHasRecords()
    {
        $id = $this->getSubscribeId();
        $workDay = $this->getWorkDay();
        $workDay->startWork();
        WorkDayEventPublisher::instance()->unsubscribe($id);
        $this->assertTrue($this->testHandler->hasRecords(Logger::INFO));
        $this->assertTrue($this->testHandler->hasRecordThatContains(
            MonologLoggerAdapter::WORK_DAY_EVENT,
            Logger::INFO
        ));
    }
}