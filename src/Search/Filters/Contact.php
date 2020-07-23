<?php


namespace Iyngaran\RealEstate\Search\Filters;

use Illuminate\Database\Eloquent\Builder;

class Contact implements Filter
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

        if (array_key_exists("id", $value)) {
            $builder->whereHas(
                'contact', function ($builder) use ($value) {
                    $builder->where('id', $value['id']);
                }
            );
        }

        if (array_key_exists("name", $value)) {
            $builder->whereHas(
                'contact', function ($builder) use ($value) {
                    $builder->where('name', 'like', $value['name']."%");
                }
            );
        }

        if (array_key_exists("email", $value)) {
            $builder->whereHas(
                'contact', function ($builder) use ($value) {
                    $builder->where('email', $value['email']);
                }
            );
        }

        return $builder;
    }
}
