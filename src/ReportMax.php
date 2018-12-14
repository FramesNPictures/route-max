<?php

namespace Fnp\RouteMax;

use Fnp\Dto\Common\DtoToArray;
use Fnp\Dto\Common\DtoToJson;

abstract class ReportMax extends RouteMax
{
    use DtoToArray;
    use DtoToJson;

    public function handle()
    {
        $arguments = func_get_args();
        $this->fill($arguments);

        return $this;
    }

    public function __toString()
    {
        return $this->toJson();
    }
}