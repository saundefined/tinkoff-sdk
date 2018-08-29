<?php

namespace Tinkoff\Business\Base;

use Tinkoff\Business\Exception\OutOfRangeException;

class BaseCollection
{
    protected $collection = [];

    public function __construct()
    {

    }

    public function add(BaseModel $collectionItem): void
    {
        $this->collection[] = $collectionItem;
    }

    public function count(): int
    {
        return \count($this->getArray());
    }

    public function getArray(): array
    {
        return $this->collection;
    }

    public function clear(): void
    {
        $this->collection = [];
    }

    public function current(): BaseModel
    {
        return current($this->collection);
    }

    public function find(callable $condition): BaseModel
    {
        for ($i = 0; $i < $this->count(); $i++) {
            if ($condition($this->at($i))) {
                return $this->at($i);
                break;
            }
        }

        throw new OutOfRangeException('Index out of bounds of collection');
    }

    public function at($index): BaseModel
    {
        if ($this->collection[$index]) {
            return $this->collection[$index];
        }

        throw new OutOfRangeException('Index out of bounds of collection');
    }
}