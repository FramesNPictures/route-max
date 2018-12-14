<?php

namespace Fnp\RouteMax;

abstract class ReportMax extends RouteMax
{
    public function handle()
    {
        $arguments = func_get_args();
        $this->fill($arguments);

        return $this;
    }
}