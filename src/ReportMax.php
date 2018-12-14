<?php

namespace Fnp\RouteMax;

use Fnp\Dto\Common\DtoToArray;
use Fnp\Dto\Common\DtoToJson;
use Fnp\Dto\Common\Flags\DtoFillFlags;
use Illuminate\Http\Request;

abstract class ReportMax extends RouteMax
{
    use DtoToArray;
    use DtoToJson;

    /**
     * ReportMax constructor.
     *
     * @param array        $data
     * @param Request|NULL $request
     */
    public function __construct($data = [], Request $request = NULL)
    {
        parent::__construct($request);

        $this->fill($data);
    }

    public function handle()
    {
        return $this;
    }

    public function __toString()
    {
        return $this->toJson();
    }
}