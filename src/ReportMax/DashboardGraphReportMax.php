<?php

namespace Fnp\RouteMax\ReportMax;

use Fnp\RouteMax\ReportMax;

abstract class DashboardGraphReportMax extends ReportMax
{
    protected $svg;

    /**
     * Produce SVG markup for the report
     * @return mixed
     */
    abstract public function getSvg();
}