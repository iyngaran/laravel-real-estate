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
                    'is_for' => ucwords(str_replace("-", " ", $this->real_estate_for)),
                    'real_estate_for' => $this->real_estate_for,
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
                    'base_currency' => RealEstateFacade::baseCurrency(),
                    'price' => [
                        'price' => $this->price,
                        'unit' => $this->price_unit
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
                    'extra_fields' => json_decode($this->extra_fields),
                    'category' => new \Iyngaran\Category\Http\Resources\Category($this->category),
                    'sub_category' => new \Iyngaran\Category\Http\Resources\Category($this->subCategory),
                    'location' => [
                        'country' => $this->location_country,
                        'state' => $this->location_state,
                        'city' => $this->location_city,
                        'address_line_1' => $this->location_address_line_1,
                        'address_line_2' => $this->location_address_line_2,
                        'coordinates' => $this->location_coordinates,
                    ],
                    'services' => new ServiceCollection($this->services),
                    'status' => $this->status,
                    'default_image' => isset($this->defaultImage)?$this->defaultImage->url:'default.png',
                    'images' => $this->images,
                    'user' => $this->user,
                    'property_phone_number_1' => $this->property_phone_number_1,
                    'property_phone_number_2' => $this->property_phone_number_2,
                    'property_email_address' => $this->property_email_address,
                    'published_at' => $this->updated_at->diffForHumans(),
                    'posted_at' => $this->created_at->diffForHumans(),
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
