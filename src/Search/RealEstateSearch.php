<?php


namespace Iyngaran\RealEstate\Search;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Iyngaran\RealEstate\Models\RealEstatePost;

class RealEstateSearch extends Search
{
    public function getResults(Request $filters)
    {
        return $this->apply($filters)->get();
    }

    public function getPaginatedResults(Request $filters, $perPage): ?LengthAwarePaginator
    {
        $currentPage = $filters->input('page');
        $reqPerPage = $filters->input('per-page');

        if ($reqPerPage) {
            $perPage = $reqPerPage;
        }

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        return $this->apply($filters, new RealEstatePost())->paginate($perPage);
    }
}
