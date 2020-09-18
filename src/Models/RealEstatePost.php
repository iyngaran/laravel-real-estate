<?php


namespace Iyngaran\RealEstate\Models;

use Actuallymab\LaravelComment\Contracts\Commentable;
use Actuallymab\LaravelComment\HasComments;
use Illuminate\Database\Eloquent\Model;

class RealEstatePost extends Model implements Commentable
{
    use HasComments;

    protected $guarded = [];

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

    public static function getTableName()
    {
        return config('iyngaran.realestate.real_estate_table_name');
    }


    public function services()
    {
        return $this->belongsToMany(
            Service::class,
            "realestate_services",
            "realestate_post_id"
        );
    }


    public function category()
    {
        return $this->belongsTo(
            \Iyngaran\Category\Models\Category::class,
            "property_category",
            "id"
        );
    }

    public function subCategory()
    {
        return $this->belongsTo(
            \Iyngaran\Category\Models\Category::class,
            "property_sub_category",
            "id"
        );
    }

    public function defaultImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_default', 'Yes');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function user()
    {
        return $this->belongsTo(config('iyngaran.realestate.user_model'), "user_id");
    }

    public function markAsPublished()
    {
        $this->status = 'Published';
        $this->save();
        return $this;
    }

    public function markAsDrafted()
    {
        $this->status = 'Drafted';
        $this->save();
        return $this;
    }

    public function markAsPending()
    {
        $this->status = 'Pending';
        $this->save();
        return $this;
    }

    public function mustBeApproved(): bool
    {
        return true; // default false
    }
}
