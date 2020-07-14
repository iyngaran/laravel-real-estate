<?php


namespace Iyngaran\RealEstate\Actions;


use Iyngaran\RealEstate\Exceptions\RealEstateNotFoundException;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Illuminate\Database\Eloquent\Collection;

class AttachServicesAction
{
    public function execute(RealEstatePost $realEstatePost, Collection $services): RealEstatePost
    {
        $newServiceIds = $services->pluck('id');
        $realEstatePost->services()->sync($newServiceIds);
        //dd($realEstatePost->services()->allRelatedIds());
        return $realEstatePost;
    }
}