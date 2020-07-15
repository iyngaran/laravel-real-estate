<?php


namespace Iyngaran\RealEstate\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Iyngaran\ApiResponse\Http\Traits\ApiResponse;
use Iyngaran\RealEstate\Http\Resources\RealEstatePostCollection;
use Iyngaran\RealEstate\Repositories\RealEstate\RealEstateRepositoryInterface;

class RealestateController
{
    use ApiResponse;

    private $_realestate;

    /**
     * RealestateController constructor.
     *
     * @param RealEstateRepositoryInterface $realestate The RealEstate Repository interface
     */
    public function __construct(RealEstateRepositoryInterface $realestate)
    {
        $this->_realestate = $realestate;
    }

    /**
     * Retrieve real estate posts
     *
     * @param $request Request The http request object
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        return $this->responseWithCollection(
            new RealEstatePostCollection($this->_realestate->search($request))
        );
    }



}