<?php

namespace App\DDD\Domain\State;

/**
 * Class State
 * @package App\DDD\Domain\State
 */
abstract class State
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @param Context $context
     */
    public function setContext(Context $context)
    {
        $this->context = $context;
    }

    abstract public function handle();
}