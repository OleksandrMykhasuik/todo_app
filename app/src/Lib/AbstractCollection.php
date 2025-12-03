<?php

namespace App\Lib;

abstract class AbstractCollection implements \IteratorAggregate
{
    protected array $items = [];

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

    public function add($item): void
    {
        $this->items[] = $item;
    }

    abstract protected function assertValue(mixed $value): void;
}
