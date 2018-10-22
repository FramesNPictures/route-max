<?php

namespace Fnp\RouteMax\Extension;

use Fnp\Dto\Flex\DtoModel;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

trait ReportSort
{
    /**
     * @var Collection
     */
    public $sort;

    public function initReportSortTrait()
    {
        $this->sort = new Collection();
        $this->initReportSort();
    }

    abstract public function initReportSort();

    /**
     * @param $sort
     *
     * @throws \Fnp\Dto\Exception\DtoClassNotExistsException
     */
    public function fillSort($sort)
    {
        $this->sort = ReportSortEntry::collection($sort);
    }

    protected function addSort($key, $order)
    {
        $entry        = new ReportSortEntry();
        $entry->key   = $key;
        $entry->order = $order;

        $this->sort->put($key, $entry);
    }

    protected function applySort($query)
    {
        /** @var Builder $query */
        /** @var ReportSortEntry $sort */
        foreach ($this->sort as $sort) {
            $query->orderBy($sort->key, $sort->order);
        }
    }
}

class ReportSortEntry extends DtoModel implements Arrayable
{
    public $key;
    public $order;
}