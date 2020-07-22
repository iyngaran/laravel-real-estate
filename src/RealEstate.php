<?php


namespace Iyngaran\RealEstate;

use Illuminate\Support\Str;

class RealEstate
{

    public function configNotPublished()
    {
        return is_null(config('iyngaran.realestate'));
    }

    public function driver()
    {
        $driver = Str::title(config('iyngaran.realestate.driver'));
        $class = "Iyngaran\RealEstate\Drivers\\".$driver."Driver";
        return new $class;
    }

    public function path()
    {
        return config('iyngaran.realestate.path', 'ads');
    }

    public function middleware()
    {
        return config('iyngaran.realestate.middleware');
    }

    public function units()
    {
        return [
            'size' => config('iyngaran.realestate.size_units'),
            'duration' => config('iyngaran.realestate.duration_units'),
            'currencies' => config('iyngaran.realestate.currencies')
        ];
    }
}