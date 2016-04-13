<?php

namespace Glavweb\SimpleTableBundle\Mapper;

use Glavweb\SimpleTableBundle\Data\TableData;

/**
 * Class TableMapper
 * @package Glavweb\SimpleTableBundle
 */
class TableMapper
{
    /**
     * @var array
     */
    private $fields;

    /**
     * @var TableData
     */
    private $data;

    /**
     * @var array
     */
    private $options = [];

    /**
     * Table constructor.
     *
     * @param TableData $data
     * @param array     $options
     * @param array     $fields
     */
    public function __construct(TableData $data, array $options = [], array $fields = [])
    {
        $this->data    = $data;
        $this->options = $options;
        $this->fields  = $fields;
    }

    /**
     * @param TableData $data
     */
    public function setData(TableData $data)
    {
        $this->data = $data;
    }

    /**
     * @return TableData
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $name
     * @param array $options
     * @return $this
     */
    public function add($name, $options = [])
    {
        $options = array_merge([
            'label'  => $name,
            'data'   => '',
            'mapped' => true,
        ], $options);

        if ($options['mapped']) {
            $tableData = $this->getData();
            if (!$tableData->hasField($name) && !$tableData->isEmpty()) {
                throw new \RuntimeException(sprintf('Fields "%s" is not mapped.', $name));
            }
        }

        $this->fields[$name] = $options;

        return $this;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param string $name
     */
    public function remove($name)
    {
        unset($this->fields[$name]);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->fields[$name]);
    }
}