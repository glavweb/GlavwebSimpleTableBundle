<?php

namespace Glavweb\SimpleTableBundle\Renderer;

use Glavweb\SimpleTableBundle\Mapper\TableGroupMapper;
use Glavweb\SimpleTableBundle\Mapper\TableMapper;

/**
 * Class Renderer
 * @package Glavweb\SimpleTableBundle\Renderer
 */
class Renderer
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * SimpleTableExtension constructor.
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param TableMapper $tableMapper
     * @return string
     */
    public function renderTable(TableMapper $tableMapper)
    {
        return $this->twig->render('"@GlavwebSimpleTable/table.html.twig', [
            'tableMapper' => $tableMapper
        ]);
    }

    /**
     * @param TableGroupMapper $tableGroupMapper
     * @return string
     */
    public function renderTableGroup(TableGroupMapper $tableGroupMapper)
    {
        $tables = $tableGroupMapper->getTables();

        $body = '';
        foreach ($tables as $table) {
            $body .= $this->renderTable($table);
        }

        return $body;
    }
}
