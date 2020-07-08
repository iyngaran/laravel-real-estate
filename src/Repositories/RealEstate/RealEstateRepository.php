<?php


namespace Iyngaran\RealEstate\Repositories\RealEstate;

use Illuminate\Pagination\LengthAwarePaginator;
use Iyngaran\RealEstate\Exceptions\RealEstateNotFoundException;
use Iyngaran\RealEstate\Models\RealEstatePost;

class RealEstateRepository implements RealEstateRepositoryInterface
{

    public function find(int $id): ?RealEstatePost
    {
        $realEstate = RealEstatePost::find($id);
        if (!$realEstate) {
            throw new RealEstateNotFoundException("The real estate id # ".$id." not found");
        }
        return $realEstate;
    }

    public function findByTitle(string $title): ?RealEstatePost
    {
        $realEstate = RealEstatePost::where('title', $title)->first();
        if (!$realEstate) {
            throw new RealEstateNotFoundException("The real estate title # ".$title." not found");
        }
        return $realEstate;
    }

    public function search(array $query): LengthAwarePaginator
    {
        // TODO: Implement search() method.
    }
}