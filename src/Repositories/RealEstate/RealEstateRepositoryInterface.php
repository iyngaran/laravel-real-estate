<?php


namespace Iyngaran\RealEstate\Repositories\RealEstate;


use Iyngaran\RealEstate\Models\RealEstatePost;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface RealEstateRepositoryInterface
{
    public function find(int $id): ? RealEstatePost;
    public function findByTitle(string $title): ? RealEstatePost;
    public function search(Request $request): ? LengthAwarePaginator;

}