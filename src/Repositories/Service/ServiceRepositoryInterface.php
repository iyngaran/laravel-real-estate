<?php


namespace Iyngaran\RealEstate\Repositories\Service;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Iyngaran\RealEstate\Models\Service;

interface ServiceRepositoryInterface
{
    public function find(int $id): ? Service;
    public function findByName(string $name): ? Collection;
    public function getAll(): ? Collection;
    public function search(array $query): Collection;
}