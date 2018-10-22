<?php

namespace Fnp\RouteMax\ReportMax;

use Fnp\RouteMax\ReportMax;

abstract class ReportMaxDashboardValue extends ReportMax
{
    protected $value;
    protected $metric;

    /**
     * Returns a dashboard value
     * @return mixed
     */
    abstract public function getValue();

    /**
     * Returns html formatted value.
     * @return mixed
     */
    abstract public function getMetric();
}