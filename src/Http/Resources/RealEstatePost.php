<?php


namespace Iyngaran\RealEstate\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Iyngaran\Category\Models\Category;
use Iyngaran\RealEstate\Facades\RealEstate as RealEstateFacade;

class RealEstatePost extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'real-estates-posts',
                'real_estates_posts_id' => $this->id,
                'attributes' => [
                    'id' => $this->id,
                    'title' => $this->title,
                    'real_estate_for' => $this->postFor,
                    'condition' => $this->condition,
                    'short_description' => $this->short_description,
                    'detail_description' => $this->detail_description,
                    'number_of_bedrooms' => $this->number_of_bedrooms,
                    'number_of_bathrooms' => $this->number_of_bathrooms,
                    'size' => [
                        'size' => $this->size,
                        'unit' => $this->size_unit,
                    ],
                    'age' => [
                        'age' => $this->age,
                        'unit' => $this->age_unit,
                    ],
                    'rent' => [
                        'rent' => $this->rent,
                        'unit' => $this->rent_unit
                    ],
                    'min_lease_term' => [
                        'term' => $this->min_lease_term,
                        'unit' => $this->min_lease_term_unit,
                    ],
                    'advanced_payment' => [
                        'payment' => number_format($this->advanced_payment, 2, '.', ','),
                        'unit' => $this->advanced_payment_unit
                    ],
                    'utility_bill_payments_included' => $this->utility_bill_payments_included,
                    'negotiable' => $this->negotiable,
                    'number_of_parking_slots' => $this->number_of_parking_slots,
                    'category' => $this->category,
                    'sub_category' => $this->subCategory,
                    'location' => [
                        'country' => $this->location_country,
                        'state' => $this->location_state,
                        'city' => $this->location_city,
                        'address_line_1' => $this->location_address_line_1,
                        'address_line_2' => $this->location_address_line_2,
                        'coordinates' => $this->location_coordinates,
                    ],
                    'contact' => $this->contact,
                    'service' => $this->services,
                    'status' => $this->status,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ]
            ],
            'links' => [
                'self' => url("api/". RealEstateFacade::path()."/real-estates/".$this->id),
            ]
        ];
    }
}