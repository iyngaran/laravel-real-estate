<?php


namespace Iyngaran\RealEstate\Actions;

use \Actuallymab\LaravelComment\Models\Comment;

class ApproveCommentAction
{
    public function execute($comment_id) : Comment
    {
        $comment = Comment::find($comment_id);
        return $comment->approve();
    }
}