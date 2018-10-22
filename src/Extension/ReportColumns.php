<?php

namespace Fnp\RouteMax\Extension;

use Fnp\Dto\Flex\DtoModel;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

trait ReportColumns
{
    /**
     * @var Collection|ReportTableColumnsColumn[]
     */
    protected $columns;

    public function initReportColumnsTrait()
    {
        $this->columns = new Collection();
        $this->initReportColumns();
    }

    abstract function initReportColumns();

    public function fillColumns($columns)
    {
        $this->columns = new Collection();

        foreach ($columns as $key => $column) {
            $this->columns->put($key, ReportTableColumnsColumn::make($column));
        }
    }

    /**
     * @param $key
     *
     * @return ReportTableColumnsColumn
     */
    protected function addColumn($key)
    {
        $column = new ReportTableColumnsColumn();
        $column->setKey($key);

        $this->columns->put($key, $column);

        return $column;
    }
}

class ReportTableColumnsColumn extends DtoModel implements Arrayable
{
    protected $key;
    protected $name;
    protected $richName;
    protected $description;
    protected $isVisible = TRUE;
    protected $class;
    protected $sortable = FALSE;

    /**
     * @param mixed $isVisible
     *
     * @return ReportTableColumnsColumn
     */
    public function setVisible($isVisible = TRUE)
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     *
     * @return ReportTableColumnsColumn
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return ReportTableColumnsColumn
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRichName()
    {
        return $this->richName;
    }

    /**
     * @param mixed $richName
     *
     * @return ReportTableColumnsColumn
     */
    public function setRichName($richName)
    {
        $this->richName = $richName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     *
     * @return ReportTableColumnsColumn
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function isVisible()
    {
        return $this->isVisible;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     *
     * @return ReportTableColumnsColumn
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSortable()
    {
        return $this->sortable;
    }

    /**
     * @param mixed $sortable
     *
     * @return ReportTableColumnsColumn
     */
    public function setSortable($sortable)
    {
        $this->sortable = $sortable;

        return $this;
    }


}