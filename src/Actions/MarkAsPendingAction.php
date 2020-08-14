<?php


namespace Iyngaran\RealEstate\Actions;


use Iyngaran\RealEstate\Exceptions\RealEstateNotFoundException;
use Iyngaran\RealEstate\Models\RealEstatePost;

class MarkAsPendingAction
{
    public function execute(int $id) : RealEstatePost
    {
        $realEstatePost = RealEstatePost::find($id);

        if (!$realEstatePost) {
            throw new RealEstateNotFoundException("The real estate post id # ".$id." not found");
        } else {
            return $realEstatePost->markAsPending();
        }
        return null;
    }
}