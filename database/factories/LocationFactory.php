<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Domain\State\Models\Location;
use Illuminate\Support\Arr;

$factory->define(Location::class, function (Faker $faker) {
    $location = $faker->randomElement(
        json_decode(file_get_contents(app_path('states.json')), true)
    );

    return Arr::except($location, 'id');
});