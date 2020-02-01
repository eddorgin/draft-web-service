<?php

namespace App\WorkDay\Infrastructure\Persistence\Doctrine;

/**
 * Class EnumWorkDayStatusType
 * @package App\WorkDay\Infrastructure\Persistence\Doctrine
 */
class EnumWorkDayStatusType extends EnumType
{
    protected $name = 'enumworkdaystatus';
    protected $values = ['active', 'pause', 'finish'];
}