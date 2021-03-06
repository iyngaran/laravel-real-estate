<?php


namespace Iyngaran\RealEstate\Search\Filters;

use Illuminate\Database\Eloquent\Builder;

class ContactName implements Filter
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
        $builder->whereHas(
            'contact', function ($builder) use ($value) {
                $builder->where('name', 'like', $value."%");
            }
        );
        return $builder;
    }
}
