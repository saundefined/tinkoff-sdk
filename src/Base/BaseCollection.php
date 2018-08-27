<?php

namespace Tinkoff\Business\Base;

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
}