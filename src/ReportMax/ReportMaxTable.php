<?php

namespace Fnp\RouteMax\ReportMax;

use Fnp\RouteMax\Extension\ReportColumns;
use Fnp\RouteMax\Extension\ReportPagination;
use Fnp\RouteMax\Extension\ReportSort;
use Fnp\RouteMax\ReportMax;

abstract class ReportMaxTable extends ReportMax
{
    use ReportColumns;
    use ReportPagination;
    use ReportSort;

    protected $data;

    abstract public function getData();
}