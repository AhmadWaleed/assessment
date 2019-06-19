<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use App\Domain\Company\Models\Company;

$factory->define(Company::class, function (Faker $faker) {
    $company = Arr::first(
        json_decode(file_get_contents(app_path('cars.json')), true)
    );

    return Arr::except($company, 'models');
});
