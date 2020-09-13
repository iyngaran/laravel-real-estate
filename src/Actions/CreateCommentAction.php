<?php


namespace Iyngaran\RealEstate\Actions;


use Illuminate\Support\Facades\App;
use Iyngaran\RealEstate\Exceptions\ContactNotFoundException;
use Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Repositories\Contact\ContactRepositoryInterface;
use \Actuallymab\LaravelComment\Models\Comment;

class CreateCommentAction
{

    public function execute(array $attributes, $user) : Comment
    {
        return $user->comment($attributes['realEstatePost'], $attributes['comment']);
    }
}