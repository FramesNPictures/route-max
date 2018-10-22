<?php

namespace Fnp\RouteMax\Extension;

use Illuminate\Support\Str;

trait ReportCache
{
    public $cache;

    public function getCacheKey($key = NULL)
    {
        if (!$key) {
            return $this->getCache() . '.'
                   . get_called_class();
        }

        if (is_array($key)) {
            $key = json_encode($key);
        }

        return $this->getCache() . '.'
               . get_called_class() . '.'
               . sha1($key);
    }

    public function getCache()
    {
        if ($this->cache) {
            return $this->cache;
        }

        return uniqid(Str::random(5) . '.', TRUE);
    }
}