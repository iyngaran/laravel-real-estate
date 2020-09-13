<?php


namespace Iyngaran\RealEstate\DataTransferObjects;

use \Illuminate\Http\Request;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Spatie\DataTransferObject\DataTransferObject;

class CommentData extends DataTransferObject
{
    /**
     * @var string|null
     */
    public $comment;

    /**
     * @var \Iyngaran\RealEstate\Models\RealEstatePost
     */
    public $realEstatePost;


    public static function fromRequest(Request $request): array
    {

        return  (
            new self(
                [
                'comment' => ucfirst($request->input('comment')),
                'realEstatePost' => RealEstatePost::find($request->input('real-estate-post-id')),
                ]
            )
        )->toArray();
    }


}