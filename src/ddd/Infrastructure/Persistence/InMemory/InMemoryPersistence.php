<?php

/**
 * Class InMemoryPersistence
 */
class InMemoryPersistence implements Persistence
{
    /**
     * @var array
     */
    private array $data = [];

    /**
     * @var int
     */
    private int $lastId = 0;

    /**
     * @return int
     */
    public function generateId(): int
    {
        $this->lastId++;

        return $this->lastId;
    }

    /**
     * @param array $data
     * @return mixed|void
     */
    public function persist(array $data)
    {
        $this->data[$this->lastId] = $data;
    }

    /**
     * @param int $id
     * @return array
     */
    public function retrieve(int $id): array
    {
        if (!isset($this->data[$id])) {
            throw new OutOfBoundsException(sprintf('No data found for ID %d', $id));
        }

        return $this->data[$id];
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function delete(int $id)
    {
        if (!isset($this->data[$id])) {
            throw new OutOfBoundsException(sprintf('No data found for ID %d', $id));
        }

        unset($this->data[$id]);
    }
}