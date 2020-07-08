<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Iyngaran\RealEstate\Models\Contact;
use \Iyngaran\RealEstate\Models\RealEstatePost;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(RealEstatePost::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'real_estate_for' => $faker->randomElement([RealEstatePost::FOR_RENT,RealEstatePost::FOR_SALE]),
        'condition' => $faker->randomElement([RealEstatePost::CONDITION_NEW,RealEstatePost::CONDITION_USED]),
        'location_country' => $faker->country,
        'location_state' => $faker->state,
        'location_city' => $faker->city,
        'location_address_line_1' => $faker->address,
        'location_address_line_2' => $faker->address,
        'location_coordinates' => $faker->randomFloat().",".$faker->randomFloat(),
        'short_description' => $faker->paragraph(1),
        'detail_description' => $faker->paragraph(3),
        'number_of_bedrooms' => $faker->randomNumber(1),
        'number_of_bathrooms' => $faker->randomNumber(1),
        'size' => $faker->randomNumber(2),
        'age' => $faker->randomNumber(1),
        'rent' => $faker->randomNumber(2),
        'min_lease_term' => $faker->randomNumber(2),
        'advanced_payment_unit' => $faker->randomElement([
            RealEstatePost::ADVANCED_PAYMENT_UNIT_MONTHS,
            RealEstatePost::ADVANCED_PAYMENT_UNIT_YEARS,
            RealEstatePost::ADVANCED_PAYMENT_UNIT_AMOUNT
        ]),
        'advanced_payment' => $faker->randomNumber(5),
        'utility_bill_payments_included' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
        'negotiable' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
        'number_of_parking_slots' => $faker->randomNumber(2),
        'property_category' => factory(\Iyngaran\Category\Models\Category::class),
        'property_sub_category' => factory(\Iyngaran\Category\Models\Category::class),
        'contact_id' => $contact = factory(Contact::class)->create()
    ];
});