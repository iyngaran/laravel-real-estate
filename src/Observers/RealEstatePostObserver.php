<?php


namespace Iyngaran\RealEstate\Observers;


use Illuminate\Support\Carbon;
use Iyngaran\RealEstate\Models\RealEstatePost;

class RealEstatePostObserver
{
    public function creating(RealEstatePost $realEstatePost)
    {
        if ($realEstatePost->status == 'Published') {
            $realEstatePost->published_at = Carbon::now();
        }
    }

    public function updating(RealEstatePost $realEstatePost)
    {
        if ($realEstatePost->status == 'Published') {
            $realEstatePost->published_at = Carbon::now();
        } else {
            $realEstatePost->published_at = null;
        }
    }
}