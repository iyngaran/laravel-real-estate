<?php


namespace Iyngaran\RealEstate\Repositories\RealEstate;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;
use Iyngaran\RealEstate\Exceptions\RealEstateNotFoundException;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Illuminate\Http\Request;
use Iyngaran\RealEstate\Search\RealEstateSearch;

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

    public function search(Request $request): ?LengthAwarePaginator
    {
        $page_limit = Config::get('iyngaran.page_limit', 20);
        return (new RealEstateSearch())->getPaginatedResults($request, $page_limit);
    }
}