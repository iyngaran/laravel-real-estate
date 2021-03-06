<?php


namespace Iyngaran\RealEstate\Search\Filters;

use Illuminate\Database\Eloquent\Builder;
use Iyngaran\RealEstate\Models\RealEstatePost;

class Condition implements Filter
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
        $condition = null;

        if (strtolower($value) == 'used') {
            $condition = RealEstatePost::CONDITION_USED;
        }

        if (strtolower($value) == 'new') {
            $condition = RealEstatePost::CONDITION_NEW;
        }

        if ($condition) {
            $builder->where('condition', $condition);
        }

        return $builder;
    }
}
