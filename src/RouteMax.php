<?php

namespace Fnp\RouteMax;

use Fnp\Dto\Common\DtoFill;
use Fnp\Dto\Common\Flags\DtoFillFlags;
use Fnp\Dto\Common\Helper\Obj;
use Illuminate\Http\Request;

abstract class RouteMax
{
    use DtoFill;

    public function __construct(Request $request)
    {
        $this->initTraits();
        $this->fill($request->all(), DtoFillFlags::FILL_PUBLIC);

        if ($request->route())
            $this->fill($request->route()->parameters(), DtoFillFlags::FILL_PUBLIC);
    }

    public static function controller($action = 'handle')
    {
        return get_called_class() . '@' . $action;
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

    abstract public function handle();
}