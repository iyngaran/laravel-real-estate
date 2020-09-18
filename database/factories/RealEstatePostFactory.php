<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Iyngaran\RealEstate\Models\Contact;
use \Iyngaran\RealEstate\Models\RealEstatePost;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Iyngaran\RealEstate\Facades\RealEstate;


$factory->define(RealEstatePost::class, function (Faker $faker) {
    $size_unit = $this->faker->randomElement(config('iyngaran.realestate.size_units'));
    $age_unit = $this->faker->randomElement(config('iyngaran.realestate.duration_units'));
    $currency = $this->faker->randomElement(config('iyngaran.realestate.currencies'));

    return [
        'title' => ucfirst($faker->sentence),
        'real_estate_for' => $faker->randomElement([RealEstatePost::FOR_RENT,RealEstatePost::FOR_SALE]),
        'condition' => $faker->randomElement([RealEstatePost::CONDITION_NEW,RealEstatePost::CONDITION_USED]),
        'location_country' => $faker->countryISOAlpha3,
        'location_state' => $faker->state,
        'location_city' => $faker->city,
        'location_address_line_1' => $faker->address,
        'location_address_line_2' => $faker->address,
        'location_coordinates' => json_encode(['latitude'=>$faker->randomFloat(),'longitude'=>$faker->randomFloat()]),
        'short_description' => $faker->sentence(20),
        'detail_description' => $faker->paragraph(3),
        'number_of_bedrooms' => $faker->randomNumber(1),
        'number_of_bathrooms' => $faker->randomNumber(1),
        'size' => $faker->randomNumber(2),
        'size_unit' => $size_unit,
        'age' => $faker->randomNumber(1),
        'age_unit' => $age_unit,
        'price' => $faker->randomNumber(5),
        'price_unit' => $age_unit,
        'min_lease_term' => $faker->randomNumber(2),
        'min_lease_term_unit' => $age_unit,
        'advanced_payment' => $faker->randomNumber(5),
        'advanced_payment_unit' => $faker->currencyCode,
        'utility_bill_payments_included' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
        'negotiable' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
        'number_of_parking_slots' => $faker->randomNumber(2),
        'property_category' => factory(\Iyngaran\Category\Models\Category::class),
        'property_sub_category' => factory(\Iyngaran\Category\Models\Category::class),
        'status' => $faker->randomElement(['Published','Drafted','Pending'])
    ];
});

$factory->afterCreating(RealEstatePost::class, function ($row, $faker) {
    $user = factory(\Iyngaran\RealEstate\Tests\Models\User::class)->create();
    $row->user()->associate($user)->save();
    $services = factory(\Iyngaran\RealEstate\Models\Service::class, 5)->create();
    $row->services()->saveMany($services);

    $row->defaultImage()->create(
        [
            'url'=> $faker->word.'.png',
            'is_default'=>'Yes',
            'display_order'=>1
        ]
    );

    $row->images()->createMany(
        [
            [
                'url'=> $faker->word.'.png',
                'display_order'=>2
            ],
            [
                'url'=> $faker->word.'.png',
                'display_order'=>3
            ]

        ]
    );


});
