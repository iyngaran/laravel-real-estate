<?php


namespace Iyngaran\RealEstate\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Iyngaran\RealEstate\Facades\RealEstate as RealEstateFacade;

class Service extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'services',
                'service_id' => $this->id,
                'attributes' => [
                    'id' => $this->id,
                    'name' => $this->name,
                    'status' => $this->status,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ]
            ],
            'links' => [
                'self' => url("api/". RealEstateFacade::path()."services/".$this->id),
            ]
        ];
    }
}