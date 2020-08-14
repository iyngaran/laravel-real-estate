<?php


namespace Iyngaran\RealEstate\Models;


use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $guarded = [];
    protected $table = 'owners';

    public function realEstates()
    {
        return $this->morphMany(RealEstatePost::class, 'owner');
    }

    public function contact()
    {
        return $this->morphOne(Contact::class, 'owner');
    }
}