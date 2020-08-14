<?php


namespace Iyngaran\RealEstate\Repositories\Service;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Iyngaran\RealEstate\Exceptions\ServiceNotFoundException;
use Iyngaran\RealEstate\Models\Service;

class ServiceRepository implements ServiceRepositoryInterface
{

    public function find(int $id): ?Service
    {
        $service = Service::find($id);
        if (!$service) {
            throw new ServiceNotFoundException("The service id # ".$id." not found");
        }
        return $service;
    }

    public function findByName(string $name): ?Collection
    {
        $service = Service::where('name','like', $name."%")->get();
        if (!$service) {
            throw new ServiceNotFoundException("The service name # ".$name." not found");
        }
        return $service;
    }

    public function getAll(): ?Collection
    {
        $services = Service::all();
        if (!$services) {
            throw new ServiceNotFoundException("The services not found");
        }
        return $services;
    }

    public function search(array $query): Collection
    {
        // TODO: Implement search() method.
    }
}