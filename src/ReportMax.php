<?php

namespace Fnp\RouteMax;

use Fnp\Dto\Common\DtoFill;
use Fnp\Dto\Common\DtoToArray;
use Fnp\Dto\Common\DtoToJson;
use Fnp\Dto\Common\Flags\DtoFillFlags;
use Fnp\Dto\Common\Helper\Obj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

abstract class ReportMax extends RouteMax
{
    use DtoFill;
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
        $this->initTraits();

        $route = [];

        if ($request) {
            $data = array_merge($data, $request->all());

            if ($request->route())
                $route = $request->route()->parameters();
        }

        $this->fill($data, DtoFillFlags::FILL_PUBLIC);
        $this->fill(
            $route,
            DtoFillFlags::FILL_PUBLIC + DtoFillFlags::FILL_PROTECTED
        );
    }

    /**
     * Boot all of the bootable traits on the model.
     *
     * @return void
     */
    protected function initTraits()
    {
        $class = static::class;

        $booted = [];

        foreach (class_uses_recursive($class) as $trait) {

            $method = Obj::methodName('init', class_basename($trait), 'Trait');

            if (method_exists($class, $method) && !in_array($method, $booted)) {
                App::call([$this, $method]);

                $booted[] = $method;
            }
        }
    }

    public function handle()
    {
        return $this->toArray();
    }

    public function __invoke(...$args)
    {
        $this->fill($args, DtoFillFlags::FILL_PUBLIC + DtoFillFlags::FILL_PROTECTED);
        $this->handle();
    }
}