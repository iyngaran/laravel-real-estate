<?php


namespace Iyngaran\RealEstate\Actions;

use \Actuallymab\LaravelComment\Models\Comment;

class ApproveCommentAction
{
    public function execute($comment) : Comment
    {
        return $comment->approve();
    }
}