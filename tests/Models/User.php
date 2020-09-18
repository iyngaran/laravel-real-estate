<?php


namespace Iyngaran\RealEstate\Tests\Models;

use Actuallymab\LaravelComment\CanComment;
use Illuminate\Database\Eloquent\Model;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Traits\HasRealEstates;

class User extends Model
{
    use CanComment,HasRealEstates;

    protected $guarded = [];

    public $timestamps = false;

    public function realEstates()
    {
        return $this->hasMany(RealEstatePost::class, 'user_id');
    }
}
