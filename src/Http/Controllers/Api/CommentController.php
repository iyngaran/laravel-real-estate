<?php


namespace Iyngaran\RealEstate\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Iyngaran\ApiResponse\Http\Traits\ApiResponse;
use Iyngaran\RealEstate\Actions\ApproveCommentAction;
use Iyngaran\RealEstate\Actions\CreateCommentAction;
use Iyngaran\RealEstate\Actions\CreateRealEstatePostAction;
use Iyngaran\RealEstate\DataTransferObjects\CommentData;
use Iyngaran\RealEstate\DataTransferObjects\RealEstateData;
use Iyngaran\RealEstate\Http\Requests\RealEstatePostRequest;
use Iyngaran\RealEstate\Http\Resources\Comment;
use Iyngaran\RealEstate\Http\Resources\CommentCollection;
use Iyngaran\RealEstate\Http\Resources\RealEstatePost;
use Iyngaran\RealEstate\Http\Resources\RealEstatePostCollection;

class CommentController
{
    use ApiResponse;

    public function store(Request $request)
    {
        return $this->createdResponse(
            new Comment((new CreateCommentAction())->execute(CommentData::fromRequest($request)), \Auth::user())
        );
    }

    public function show(\Iyngaran\RealEstate\Models\RealEstatePost $realEstatePost)
    {
        return $this->responseWithCollection(
            new CommentCollection($realEstatePost->comments)
        );
    }

    public function update(\Actuallymab\LaravelComment\Models\Comment $comment, $id)
    {
        return $this->updatedResponse(
            new Comment((new ApproveCommentAction())->execute($comment))
        );
    }

    public function approvedComments(\Iyngaran\RealEstate\Models\RealEstatePost $realEstatePost)
    {
        return $this->responseWithCollection(
            new CommentCollection($realEstatePost->comments()->approvedComments()->get())
        );
    }
}