<?php

namespace Fnp\RouteMax;

use Fnp\Dto\Common\DtoFill;
use Fnp\Dto\Common\DtoToArray;
use Fnp\Dto\Common\DtoToJson;
use Fnp\Dto\Common\Helper\Obj;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

abstract class ReportMax implements Arrayable
{
    use DtoFill;
    use DtoToArray;
    use DtoToJson;

    public function __construct(Request $request = NULL, $data = [])
    {
        $this->initTraits();

        if ($request) {
            $data = $request->all();
        }

        $this->fill($data);
    }

    public static function make($data)
    {
        return new static(NULL, $data);
    }

    public function handle()
    {
        return $this;
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
                \App::call([$this, $method]);

                $booted[] = $method;
            }
        }
    }

    public static function controller()
    {
        return get_called_class() . '@handle';
    }
}