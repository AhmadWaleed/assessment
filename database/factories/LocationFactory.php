<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use App\Domain\State\Models\Location;

$factory->define(Location::class, function (Faker $faker) {
    $location = $faker->randomElement(
        json_decode(file_get_contents(app_path('states.json')), true)
    );

    return Arr::except($location, 'id');
});
