<?php

namespace App\Tests;

use App\DDD\Domain\Entity\EntityId;
use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Domain\WorkDayEventPublisher;
use PHPUnit\Framework\TestCase;

class TestCaseWrapper extends TestCase
{
    protected $subscriber;

    /**
     * @return WorkDay
     * @throws \Exception
     */
    protected function getWorkDay()
    {
        return new WorkDay(new EntityId());
    }

    /**
     * @return mixed
     */
    protected function getSubscribeId()
    {
        return WorkDayEventPublisher::instance()->subscribe($this->subscriber);
    }
}