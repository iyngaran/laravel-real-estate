<?php


namespace Iyngaran\RealEstate\Actions;


use Iyngaran\RealEstate\Models\RealEstatePost;

class CreateRealEstatePostAction
{
    public function execute(array $attributes): RealEstatePost
    {
        $realEstatePost = RealEstatePost::create(
            [
                'title' => $attributes['title'],
                'real_estate_for' => $attributes['realEstateFor'],
                'condition' => $attributes['condition'],
                'location_country' => $attributes['country'],
                'location_state' => $attributes['state'],
                'location_city' => $attributes['city'],
                'location_address_line_1' => $attributes['addressLine_1'],
                'location_address_line_2' => $attributes['addressLine_2'],
                'location_coordinates' => $attributes['coordinates'],
                'short_description' => $attributes['shortDescription'],
                'detail_description' => $attributes['detailDescription'],
                'number_of_bedrooms' => $attributes['numberOfBedrooms'],
                'number_of_bathrooms' => $attributes['numberOfBathrooms'],
                'size' => $attributes['size'],
                'size_unit' => $attributes['sizeUnit'],
                'age' => $attributes['age'],
                'age_unit' => $attributes['ageUnit'],
                'rent' => $attributes['rent'],
                'rent_unit' => $attributes['rentUnit'],
                'min_lease_term' => $attributes['minLeaseTerm'],
                'min_lease_term_unit' => $attributes['minLeaseTermUnit'],
                'advanced_payment' => $attributes['advancedPayment'],
                'advanced_payment_unit' => $attributes['advancedPaymentUnit'],
                'utility_bill_payments_included' => $attributes['utilityBillPaymentsIncluded'],
                'negotiable' => $attributes['negotiable'],
                'number_of_parking_slots' => $attributes['numberOfParkingSlots']
            ]
        );

        if ($realEstatePost) {
            $realEstatePost->contact()->associate($attributes['contact']);
            $realEstatePost->category()->associate($attributes['category']);
            $realEstatePost->subCategory()->associate($attributes['subCategory']);
            $realEstatePost->services()->sync($attributes['services']);
        }

        return $realEstatePost;
    }
}