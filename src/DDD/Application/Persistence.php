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
     * @param array $data
     * @return mixed
     */
    public function persist(array $data);

    /**
     * @param int $id
     * @return array
     */
    public function retrieve(int $id): array;

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}