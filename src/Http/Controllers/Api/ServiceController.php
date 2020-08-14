<?php


namespace Iyngaran\RealEstate\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;
use Iyngaran\ApiResponse\Http\Traits\ApiResponse;
use Iyngaran\RealEstate\Http\Resources\Service;
use Iyngaran\RealEstate\Http\Resources\ServiceCollection;
use Iyngaran\RealEstate\Repositories\Service\ServiceRepositoryInterface;

class ServiceController
{
    use ApiResponse;

    private $_service;

    public function __construct(ServiceRepositoryInterface $service)
    {
        $this->_service = $service;
    }

    /**
     * Get all services
     *
     * @return JsonResponse
     */
    public function index()
    {
        return $this->responseWithItem(new ServiceCollection($this->_service->getAll()));
    }


    public function searchByName($name)
    {
        return $this->responseWithItem(new ServiceCollection($this->_service->findByName($name)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id The service id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        return $this->responseWithItem(new Service($this->_service->find($id)));
    }

}