<?php

namespace App\DDD\Application;

/**
 * Interface Persistence
 * @package App\DDD\Application
 */
interface Persistence
{
    /**
     * @return int
     */
    public function generateId(): int;

    /**
     * @param $data
     * @return mixed
     */
    public function persist($data);

    /**
     * @param int $id
     * @return mixed
     */
    public function retrieve(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}