<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Domain\Customer\Models\Customer;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name('male')
    ];
});