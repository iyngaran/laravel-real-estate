<?php


namespace Iyngaran\RealEstate\Traits;


use Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Models\RealEstatePost;

trait HasRealEstates
{
    public function realEstates()
    {
        return $this->morphMany(RealEstatePost::class, 'user');
    }
}