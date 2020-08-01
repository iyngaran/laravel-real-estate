<?php


namespace Iyngaran\RealEstate\Actions;


use Iyngaran\RealEstate\Exceptions\RealEstateNotFoundException;
use Iyngaran\RealEstate\Models\Image;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Illuminate\Database\Eloquent\Collection;

class AttachDefaultImageAction
{
    public function execute(RealEstatePost $realEstatePost, array $image): RealEstatePost
    {
        if(isset($image['url'])) {
            if ($realEstatePost->defaultImage()->exists()) {
                $realEstatePost->defaultImage->delete();
            }
            $image['is_default'] = 'Yes';
            $realEstatePost->defaultImage()->create($image);
        }
        return $realEstatePost;
    }
}