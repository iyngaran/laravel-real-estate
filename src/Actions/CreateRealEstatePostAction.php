<?php


namespace Iyngaran\RealEstate\Actions;


use Illuminate\Support\Facades\Log;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Facades\RealEstate;

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
                'price' => $attributes['price'],
                'price_unit' => $attributes['priceUnit'],
                'min_lease_term' => $attributes['minLeaseTerm'],
                'min_lease_term_unit' => $attributes['minLeaseTermUnit'],
                'advanced_payment' => $attributes['advancedPayment'],
                'advanced_payment_unit' => $attributes['advancedPaymentUnit'],
                'utility_bill_payments_included' => $attributes['utilityBillPaymentsIncluded'],
                'negotiable' => $attributes['negotiable'],
                'number_of_parking_slots' => $attributes['numberOfParkingSlots'],
                'extra_fields' => json_encode($attributes['extraFields']),
                'property_phone_number_1' => $attributes['property_phone_number_1'],
                'property_phone_number_2' => $attributes['property_phone_number_2'],
                'property_email_address' => $attributes['property_email_address'],
                'status' => isset($attributes['status']) ? $attributes['status'] : RealEstate::defaultPostStatus()
            ]
        );


        if ($realEstatePost) {

            if ($attributes['user']) {
                $realEstatePost->user()->associate($attributes['user'])->save();
            }

            if ($attributes['category']) {
                $realEstatePost->category()->associate($attributes['category'])->save();
            }

            if ($attributes['subCategory']) {
                $realEstatePost->subCategory()->associate($attributes['subCategory'])->save();
            }

            if ($attributes['services']) {
                $realEstatePost = (new AttachServicesAction())->execute($realEstatePost, $attributes['services']);
            }

            if ($attributes['defaultImage']) {
                $realEstatePost = (new AttachDefaultImageAction())->execute($realEstatePost, $attributes['defaultImage']);
            }

            if ($attributes['images']) {
                $realEstatePost = (new AttachImagesAction())->execute($realEstatePost, $attributes['images']);
            }

        }

        return $realEstatePost;
    }
}
