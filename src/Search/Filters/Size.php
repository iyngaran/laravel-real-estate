<?php


namespace Iyngaran\RealEstate\Search\Filters;

use Illuminate\Database\Eloquent\Builder;

class Size implements Filter
{

    /**
     * Apply a given search value to the builder instance.
     *
     * @param  Builder $builder
     * @param  mixed   $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        $builder->where('size', $value);
        return $builder;
    }
}
