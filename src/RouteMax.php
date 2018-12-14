<?php

namespace Fnp\RouteMax;

use Fnp\Dto\Common\DtoFill;
use Fnp\Dto\Common\DtoToArray;
use Fnp\Dto\Common\Flags\DtoFillFlags;
use Fnp\Dto\Common\Helper\Obj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

abstract class RouteMax
{
    use DtoFill;

    public function __construct(Request $request = NULL)
    {
        $this->initTraits();

        if ($request) {
            $this->fill($request->all(), DtoFillFlags::FILL_PUBLIC);

            if ($request->route())
                $this->fill($request->route()->parameters(), DtoFillFlags::FILL_PUBLIC);
        }
    }

    public static function action($action = 'handle')
    {
        return get_called_class() . '@' . $action;
    }

    /**
     * @param string $action
     * @deprecated Will be removed in the next version
     *
     * @return string
     */
    public static function controller($action = 'handle')
    {
        return get_called_class() . '@' . $action;
    }

    public static function get($url, $action = 'handle')
    {
        return Route::get($url, self::action($action));
    }

    public static function post($url, $action = 'handle')
    {
        return Route::get($url, self::action($action));
    }

    public static function put($url, $action = 'handle')
    {
        return Route::put($url, self::action($action));
    }

    public static function delete($url, $action = 'handle')
    {
        return Route::delete($url, self::action($action));
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
}