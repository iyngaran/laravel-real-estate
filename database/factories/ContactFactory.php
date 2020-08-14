<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use \Iyngaran\RealEstate\Models\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    $owner = factory(\Iyngaran\RealEstate\Models\Owner::class)->create();

    return [
        'name' => $faker->firstName,
        'email' => $faker->email,
        'contact_numbers' => $faker->phoneNumber.",".$faker->phoneNumber,
        'owner_id' => $owner->id,
        'owner_type' => get_class($owner),
    ];
});