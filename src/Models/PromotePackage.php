<?php


namespace Iyngaran\RealEstate\Models;


use Illuminate\Database\Eloquent\Model;

class PromotePackage extends Model
{
        protected $table = "promote_packages";
        protected $guarded = [];

        public function realEstatePosts() {
            return $this->belongsToMany(RealEstatePost::class);
        }
}
