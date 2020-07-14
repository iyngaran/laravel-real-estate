<?php


namespace Iyngaran\RealEstate\Actions;


use Iyngaran\RealEstate\Exceptions\RealEstateNotFoundException;
use Iyngaran\RealEstate\Models\RealEstatePost;

class DeleteRealEstatePostAction
{
    public function execute(int $id) : bool
    {
        $realEstatePost = RealEstatePost::find($id);

        if (!$realEstatePost) {
            throw new RealEstateNotFoundException("The real estate post id # ".$id." not found");
        } else {
            $realEstatePost->services()->detach();
            return $realEstatePost->delete();
        }
        return null;
    }
}