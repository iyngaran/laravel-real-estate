<?php


namespace Iyngaran\RealEstate\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Iyngaran\RealEstate\Facades\RealEstate as RealEstateFacade;

class Contact extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'contacts',
                'contact_id' => $this->id,
                'attributes' => [
                    'id' => $this->id,
                    'name' => $this->name,
                    'contact_numbers' => $this->contact_numbers,
                    'email' => $this->email
                ]
            ],
            'links' => [
                'self' => url("api/". RealEstateFacade::path()."contacts/".$this->id),
            ]
        ];
    }
}