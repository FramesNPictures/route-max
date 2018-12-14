<?php

namespace Fnp\RouteMax\ReportMax\Eloquent;

trait ProvidesAliases
{
    public static function column($name, $as = NULL)
    {
        return self::TABLE . '.' . $name . ($as ? ' AS ' . $as : '');
    }

    public static function alias($alias)
    {
        return new DbAlias(self::TABLE, $alias);
    }

    public static function tableWithIndexes($indexes)
    {
        if (!is_array($indexes)) $indexes = [$indexes];
        return \DB::raw(self::TABLE.' USE INDEX ('.implode(',', $indexes).')');
    }
}

class DbAlias
{
    protected $table;
    protected $alias;

    public function __construct($table, $alias)
    {
        $this->table = $table;
        $this->alias = $alias;
    }

    public function column($name, $as = NULL)
    {
        return $this->alias . '.' . $name . ($as ? ' AS ' . $as : '');
    }

    public function sum($name, $as = NULL)
    {
        return \DB::raw('SUM(' . $this->alias . '.' . $name . ')' . ($as ? ' AS ' . $as : ''));
    }

    public function avg($name, $as = NULL)
    {
        return \DB::raw('AVG(' . $this->alias . '.' . $name . ')' . ($as ? ' AS ' . $as : ''));
    }

    public function count($name, $as = NULL)
    {
        return \DB::raw('COUNT(' . $this->alias . '.' . $name . ')' . ($as ? ' AS ' . $as : ''));
    }


    public function table()
    {
        return $this->table . ' AS ' . $this->alias;
    }
}