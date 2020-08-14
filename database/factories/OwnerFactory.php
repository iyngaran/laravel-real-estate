<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use \Iyngaran\RealEstate\Models\Owner;

$factory->define(Owner::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->word),
        'email' => $faker->email
    ];
});