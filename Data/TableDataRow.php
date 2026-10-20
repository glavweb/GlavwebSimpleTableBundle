<?php

namespace Glavweb\SimpleTableBundle\Data;

/**
 * Class TableDataRow
 * @package Glavweb\SimpleTableBundle
 */
class TableDataRow implements \Iterator
{
    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $fieldsMap;

    /**
     * TableDataRow constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->fieldsMap  = array_keys($data);
    }

    /**
     * @return array
     */
    public function getFieldsMap()
    {
        return $this->fieldsMap;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $name
     */
    public function get($name)
    {
        if (!isset($this->data[$name])) {
            throw new \RuntimeException(sprintf('Field %s name not found.', $name));
        }

        return $this->data[$name];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * @return mixed
     */
    public function current(): mixed
    {
        return $this->data[$this->position];
    }

    /**
     * @return int
     */
    public function key(): mixed
    {
        return $this->position;
    }

    /**
     * @return void
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->data[$this->position]);
    }
}
