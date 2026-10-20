<?php

namespace Glavweb\SimpleTableBundle\Data;

/**
 * Class TableData
 * @package Glavweb\SimpleTableBundle
 */
class TableData implements \Iterator
{
    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var TableDataRow[]
     */
    private $data;

    /**
     * @var array
     */
    private $fieldsMap = [];

    /**
     * TableData constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $row) {
            $row = new TableDataRow($row);

            $this->fieldsMap = $this->fieldsMap + $row->getFieldsMap();
            $this->data[] = $row;
        }
    }

    /**
     * @return array
     */
    public function getFieldsMap()
    {
        return $this->fieldsMap;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasField($name)
    {
        return in_array($name, $this->fieldsMap);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
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

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->data);
    }
}
