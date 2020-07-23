<?php


namespace Iyngaran\RealEstate\Search\Filters;

use Illuminate\Database\Eloquent\Builder;

class Location implements Filter
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
        if (array_key_exists("country", $value)) {
            $builder->where('location_country', $value['country']);
        }

        if (array_key_exists("state", $value)) {
            $builder->where('location_state', $value['state']);
        }

        if (array_key_exists("city", $value)) {
            $builder->where('location_city', $value['city']);
        }

        return $builder;
    }
}
