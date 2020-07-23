<?php


namespace Iyngaran\RealEstate\Search\Filters;

use Illuminate\Database\Eloquent\Builder;

class SubCategory implements Filter
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
        if (is_array($value)) {
            if (array_key_exists("id", $value)) {
                $builder->where('property_sub_category', $value['id']);
            }

            if (array_key_exists("name", $value)) {
                $builder->whereHas(
                    'subCategory', function ($builder) use ($value) {
                        $builder->where('name', 'like', $value['name']."%");
                    }
                );
            }
        }

        return $builder;
    }
}
