<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use \Iyngaran\RealEstate\Models\Service;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'name' => $faker->title
    ];
});