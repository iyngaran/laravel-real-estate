<?php


namespace Iyngaran\RealEstate\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Iyngaran\RealEstate\Facades\RealEstate as RealEstateFacade;

class PromotePackage extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'promote_packages',
                'promote_package_id' => $this->id,
                'attributes' => [
                    'id' => $this->id,
                    'package_name' => $this->package_name,
                    'short_description' => $this->short_description,
                    'detail_description' => $this->detail_description,
                    'status' => $this->status,
                    'display_order' => $this->display_order,
                ]
            ],
            'links' => [
                'self' => url("api/". RealEstateFacade::path()."promote-packages/".$this->id),
            ]
        ];
    }
}
