<?php

namespace Glavweb\SimpleTableBundle\Twig;

use Glavweb\SimpleTableBundle\Mapper\TableGroupMapper;
use Glavweb\SimpleTableBundle\Mapper\TableMapper;
use Glavweb\SimpleTableBundle\Renderer\Renderer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class SimpleTableExtension
 * @package Glavweb\SimpleTableBundle\Twig
 */
class SimpleTableExtension extends AbstractExtension
{
    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * SimpleTableExtension constructor.
     *
     * @param Renderer $renderer
     */
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'glavweb_simple_table_extension';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('glavweb_simple_table_render', [$this, 'renderTable'], ['is_safe' => ['html']]),
            new TwigFunction('glavweb_simple_table_render_group', [$this, 'renderTableGroup'], ['is_safe' => ['html']])
        ];
    }

    /**
     * @param TableMapper $table
     * @return string
     */
    public function renderTable(TableMapper $table)
    {
        return $this->renderer->renderTable($table);
    }

    /**
     * @param TableGroupMapper $tableGroup
     * @return string
     */
    public function renderTableGroup(TableGroupMapper $tableGroup)
    {
        return $this->renderer->renderTableGroup($tableGroup);
    }
}