<?php


namespace Iyngaran\RealEstate\Traits;


use Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Models\RealEstatePost;

class HasRealEstates
{
    public function realEstates()
    {
        return $this->morphMany(RealEstatePost::class, 'owner');
    }

    public function contact()
    {
        return $this->morphOne(Contact::class, 'owner');
    }
}