<?php


namespace Iyngaran\RealEstate\Models;


use Illuminate\Database\Eloquent\Model;

class RealEstatePost extends Model
{
    protected $guarded = [];
    protected $table = 'real_estate_posts';

    const YES = 1;
    const NO = 2;

    const CONDITION_USED = 1;
    const CONDITION_NEW = 2;


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'location_coordinates' => 'array'
    ];

    public function services()
    {
        return $this->belongsToMany(
            Service::class,
            "realestate_services",
            "realestate_post_id"
        );
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, "contact_id");
    }

    /*
     * Sale / Rent
     */
    public function postFor()
    {
        return $this->belongsTo(\Iyngaran\Category\Models\Category::class, "real_estate_for");
    }

    public function category()
    {
        return $this->belongsTo(\Iyngaran\Category\Models\Category::class, "property_category");
    }

    public function subCategory()
    {
        return $this->belongsTo(\Iyngaran\Category\Models\Category::class, "property_sub_category");
    }

}