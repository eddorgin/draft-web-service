<?php

namespace App\DDD\Application;

/**
 * Interface TransactionalSession
 * @package App\DDD\Application
 */
interface TransactionalSession
{
    /**
     * @param callable $operation
     *
     * @return mixed
     */
    public function executeAtomically(callable $operation);
}