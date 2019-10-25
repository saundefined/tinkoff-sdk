<?php

namespace Tinkoff\Business\Base;

use Tinkoff\Business\Exception\OutOfRangeException;
use function count;

class BaseCollection implements \Iterator
{
    protected $collection = [];

    public function __construct()
    {

    }

    public function add($collectionItem): void
    {
        $this->collection[] = $collectionItem;
    }

    public function clear(): void
    {
        $this->collection = [];
    }

    public function find(callable $condition)
    {
        for ($i = 0; $i < $this->count(); $i++) {
            if ($condition($this->at($i))) {
                return $this->at($i);
            }
        }

        throw new OutOfRangeException('Index out of bounds of collection');
    }

    public function count(): int
    {
        return count($this->getArray());
    }

    public function getArray(): array
    {
        return $this->collection;
    }

    public function at($index)
    {
        if ($this->collection[$index]) {
            return $this->collection[$index];
        }

        throw new OutOfRangeException('Index out of bounds of collection');
    }

    public function current()
    {
        return current($this->collection);
    }

    public function next()
    {
        return next($this->collection);
    }

    public function key()
    {
        return key($this->collection);
    }

    public function valid(): bool
    {
        return (bool)current($this->collection);
    }

    public function rewind(): void
    {
        reset($this->collection);
    }
}
