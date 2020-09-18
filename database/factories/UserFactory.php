<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use \Iyngaran\RealEstate\Tests\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName
    ];
});