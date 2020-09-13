<?php


namespace Iyngaran\RealEstate\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Iyngaran\ApiResponse\Http\Traits\ApiResponse;
use Iyngaran\RealEstate\Actions\CreateRealEstatePostAction;
use Iyngaran\RealEstate\DataTransferObjects\RealEstateData;
use Iyngaran\RealEstate\Http\Requests\RealEstatePostRequest;
use Iyngaran\RealEstate\Http\Resources\RealEstatePost;

class CommentController
{
    use ApiResponse;

    public function store(Request $request)
    {

       $post = \Iyngaran\RealEstate\Models\RealEstatePost::find(925);
       $user = \Auth::user();
       $user->comment($post, 'Lorem ipsum ..');
       dd($post->comments);

    }
}