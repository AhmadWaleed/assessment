<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Domain\Company\Models\Model;
use Illuminate\Support\Arr;

$factory->define(Model::class, function (Faker $faker) {

    $company = Arr::first(
        json_decode(file_get_contents(app_path('cars.json')), true)
    );

    $models = Arr::only($company, 'models');

    return $faker->randomElement($models['models']);
});
