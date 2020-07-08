<?php


namespace Iyngaran\RealEstate\Models;


class Category extends \Iyngaran\Category\Models\Category
{
    public function realEstatePosts()
    {
        return $this->hasMany(RealEstatePost::class);
    }
}