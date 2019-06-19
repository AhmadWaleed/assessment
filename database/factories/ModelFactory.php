<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use App\Domain\Company\Models\Model;

$factory->define(Model::class, function (Faker $faker) {
    $company = Arr::first(
        json_decode(file_get_contents(app_path('cars.json')), true)
    );

    $models = Arr::only($company, 'models');

    return $faker->randomElement($models['models']);
});
