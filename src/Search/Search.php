<?php


namespace Iyngaran\RealEstate\Search;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Search
{
    protected function apply(Request $filters, Model $model)
    {
        $query = static::applyDecoratorsFromRequest($filters, $model->newQuery());
        return $query;
    }

    private static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        foreach ($request->all() as $filterName => $value) {
            if (isset($value) && !empty($value)) {
                $decorator = static::createFilterDecorator($filterName);

                if (static::isValidDecorator($decorator)) {
                    $query = $decorator::apply($query, $value);
                }
            }

        }
        return $query;
    }

    private static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' . studly_case($name);
    }

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }
}
