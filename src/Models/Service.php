<?php


namespace Iyngaran\RealEstate\Models;


use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];
    protected $table = 'services';

    const ENABLED = 1;
    const DISABLED = 0;

    public function realEstatePosts()
    {
        return $this->belongsToMany(
            RealEstatePost::class,
            "realestate_services",
            "service_id"
        );
    }

}