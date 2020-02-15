<?php

namespace App\WorkDay\Infrastructure\Persistence\Doctrine;

/**
 * Class EnumWorkDayStatusType
 * @package App\WorkDay\Infrastructure\Persistence\Doctrine
 */
class EnumWorkDayStatusType extends EnumType
{
    protected $name = 'EnumWorkDayStatus';
    protected $values = ['active', 'paused', 'finished'];
}