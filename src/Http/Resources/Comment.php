<?php


namespace Iyngaran\RealEstate\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Iyngaran\RealEstate\Facades\RealEstate as RealEstateFacade;

class Comment extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'comments',
                'comment_id' => $this->id,
                'attributes' => [
                    'id' => $this->id,
                    'comment' => $this->comment,
                    'comment_on_type' => $this->commentable_type,
                    'comment_on_id' => $this->commentable_id,
                    'added_by' => $this->commented_id,
                ]
            ],
            'links' => [
                'self' => url("api/". RealEstateFacade::path()."contacts/".$this->id),
            ]
        ];
    }
}