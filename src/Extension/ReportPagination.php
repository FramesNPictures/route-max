<?php

namespace Fnp\RouteMax\Extension;

trait ReportPagination
{
    protected $page;
    protected $pagesTotal;
    protected $itemsTotal;
    protected $itemsPerPage = 50;

    public function getPage()
    {
        if (!$this->page) {
            $this->page = 1;
        }

        if ($this->page > $this->getPagesTotal()) {
            $this->page = $this->getPagesTotal();
        }

        return $this->page;
    }

    public function getPagesTotal()
    {
        return ceil($this->getItemsTotal() / $this->itemsPerPage);
    }

    protected function applyPagination($query)
    {
        $query->forPage($this->getPage(), $this->itemsPerPage);
    }

    abstract public function getItemsTotal();
}