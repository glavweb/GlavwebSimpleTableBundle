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
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->data[$this->position];
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @return void
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * @return bool
     */
    public function valid()
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