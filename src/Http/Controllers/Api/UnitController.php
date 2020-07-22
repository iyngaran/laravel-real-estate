<?php


namespace Iyngaran\RealEstate\Http\Controllers\Api;


use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Iyngaran\ApiResponse\Http\Traits\ApiResponse;
use Iyngaran\RealEstate\Facades\RealEstate;

class UnitController
{
    use ApiResponse;


    public function size()
    {
        return response()->json(
            [
                'sizes' => RealEstate::units()['size'],
            ], Response::HTTP_OK
        );
    }

    public function duration()
    {
        return response()->json(
            [
                'durations' => RealEstate::units()['duration'],
            ], Response::HTTP_OK
        );
    }

    public function currency()
    {
        return response()->json(
            [
                'currencies' => RealEstate::units()['currencies'],
            ], Response::HTTP_OK
        );
    }
}