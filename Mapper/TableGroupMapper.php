<?php

namespace Glavweb\SimpleTableBundle\Mapper;

use Glavweb\SimpleTableBundle\Data\TableData;

/**
 * Class TableGroupMapper
 * @package Glavweb\SimpleTableBundle
 */
class TableGroupMapper
{
    /**
     * @var string
     */
    private $currentTable = null;

    /**
     * @var TableMapper[]
     */
    private $tables;

    /**
     * @param string    $name
     * @param TableData $data
     * @param array     $options
     * @return TableGroupMapper
     */
    public function table($name, TableData $data = null, array $options = null)
    {
        if ($this->currentTable) {
            throw new \RuntimeException(sprintf('Table "%s" is already defined.', $name));
        }

        $this->currentTable = $name;

        if ($options !== null) {
            $options = array_merge([
                'label'  => $name,
                'class'  => 'table',
                'footer' => null,
            ], $options);
        }

        if (!isset($this->tables[$name])) {
            $this->tables[$name] = new TableMapper($data, $options);

        } else {
            $table = $this->tables[$name];

            if ($data) {
                $table->setData($data);
            }

            if ($options !== null) {
                $table->setOptions($options);
            }
        }

        return $this;
    }

    /**
     * @return TableGroupMapper
     */
    public function end()
    {
        $this->currentTable = null;

        return $this;
    }

    /**
     * @param string $name
     * @param array $options
     * @return TableGroupMapper
     */
    public function add($name, $options = [])
    {
        $currentTable = $this->currentTable;
        if (!$this->currentTable) {
            throw new \RuntimeException(sprintf('Table "%s" is not defined.', $name));
        }

        $table = $this->tables[$currentTable];
        $table->add($name, $options);

        return $this;
    }

    /**
     * @param string $name
     */
    public function remove($name)
    {
        $currentTable = $this->currentTable;
        if (!$this->currentTable) {
            throw new \RuntimeException(sprintf('Table "%s" is not defined.', $name));
        }

        $table = $this->tables[$currentTable];
        $table->remove($name);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        $currentTable = $this->currentTable;
        if (!$this->currentTable) {
            throw new \RuntimeException(sprintf('Table "%s" is not defined.', $name));
        }

        $table = $this->tables[$currentTable];
        return $table->has($name);
    }

    /**
     * @param string $name
     * @return TableMapper
     */
    public function getTable($name)
    {
        return $this->tables[$name];
    }

    /**
     * @return TableMapper[]
     */
    public function getTables()
    {
        return $this->tables;
    }
}