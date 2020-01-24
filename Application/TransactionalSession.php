<?php

/**
 * Interface TransactionalSession
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