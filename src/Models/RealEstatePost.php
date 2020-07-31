<?php


namespace Iyngaran\RealEstate\Models;


use Illuminate\Database\Eloquent\Model;

class RealEstatePost extends Model
{
    protected $guarded = [];
    protected $table = 'real_estate_posts';

    const YES = 'Yes';
    const NO = 'No';

    const FOR_SALE = 'for-sale';
    const FOR_RENT = 'for-rent';

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

    public function category()
    {
        return $this->belongsTo(\Iyngaran\Category\Models\Category::class, "property_category", "id");
    }

    public function subCategory()
    {
        return $this->belongsTo(\Iyngaran\Category\Models\Category::class, "property_sub_category", "id");
    }

    public function defaultImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_default', 'Yes');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}