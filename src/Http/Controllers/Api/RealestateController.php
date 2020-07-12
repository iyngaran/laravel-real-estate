<?php


namespace Iyngaran\RealEstate\Http\Controllers\Api;


use Iyngaran\ApiResponse\Http\Traits\ApiResponse;
use Iyngaran\RealEstate\Repositories\RealEstate\RealEstateRepositoryInterface;

class RealestateController
{
    use ApiResponse;

    private $_realestate;

    public function __construct(RealEstateRepositoryInterface $realestate)
    {
        $this->_realestate = $realestate;
    }
}