<?php


namespace App\DDD\Domain\State;


interface Context
{
    public function transitionTo(State $state);
}