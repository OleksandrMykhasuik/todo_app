<?php

namespace App\Lib;

abstract class AbstractDtoMap implements \IteratorAggregate, \ArrayAccess
{
    protected $items = [];

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

    public function set($key, $value): void
    {
        $this->assertValue($value);
        $this->items[$this->getKeyValue($key)] = $value;
    }

    public function get($key): mixed
    {
        $result =  $this->items[$this->getKeyValue($key)];
        $this->assertValue($result);
        return $result;
    }

    public function has($key): bool
    {
        return \isset($this->items[$this->getKeyValue($key)]);
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->set($offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[$offset->name]);
    }

    public function toArray(): array
    {
        return $this->items;
    }

    abstract protected function getKeyValue(mixed $key): string;

    abstract protected function assertValue(mixed $value): void;
}
