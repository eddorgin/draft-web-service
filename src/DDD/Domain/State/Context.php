<?php


namespace App\DDD\Domain\State;

/**
 * Interface Context
 * @package App\DDD\Domain\State
 */
interface Context
{
    /**
     * @param State $state
     * @return mixed
     */
    public function transitionTo(State $state);
}