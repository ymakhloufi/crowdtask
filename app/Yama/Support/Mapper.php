<?php

namespace Yama\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class Mapper
{
    /**
     * @param Model $model
     *
     * @return array
     */
    abstract public static function single(Model $model): array;


    /**
     * @param Collection $collection
     *
     * @return Collection
     */
    public static function collection(Collection $collection): Collection
    {
        return $collection->map(function (Model $item) {
            return static::single($item);
        });
    }
}
