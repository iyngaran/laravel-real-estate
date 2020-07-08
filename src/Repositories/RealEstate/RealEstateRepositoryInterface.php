<?php


namespace Iyngaran\RealEstate\Repositories\RealEstate;


use Iyngaran\RealEstate\Models\RealEstatePost;
use Illuminate\Pagination\LengthAwarePaginator;

interface RealEstateRepositoryInterface
{
    public function find(int $id): ? RealEstatePost;
    public function findByTitle(string $title): ? RealEstatePost;
    public function search(array $query): LengthAwarePaginator;

}