<?php


namespace Iyngaran\RealEstate\Actions;


use Iyngaran\RealEstate\Exceptions\RealEstateNotFoundException;
use Iyngaran\RealEstate\Models\Image;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Illuminate\Database\Eloquent\Collection;

class AttachImagesAction
{
    public function execute(RealEstatePost $realEstatePost, array $image): RealEstatePost
    {
        if ($realEstatePost->images()->exists()) {
            foreach ($realEstatePost->images() as $image) {
                $image->delete();
            }
        }
        $realEstatePost->images()->createMany($image);
        return $realEstatePost;
    }
}