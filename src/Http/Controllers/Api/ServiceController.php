<?php


namespace Iyngaran\RealEstate\Http\Controllers\Api;


use Iyngaran\ApiResponse\Http\Traits\ApiResponse;
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

    /**
     * Search categories
     *
     * @return JsonResponse
     */
    public function search()
    {
        return $this->responseWithItem(new ServiceCollection($this->_service->search([])));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id The service id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        return $this->responseWithItem($this->_service->find($id));
    }

}