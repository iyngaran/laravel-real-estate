<?php


namespace Iyngaran\RealEstate\Facades;

use Illuminate\Support\Facades\Facade;

class RealEstate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RealEstate';
    }
}