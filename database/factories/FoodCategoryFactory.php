<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FoodCategory;
use Faker\Generator as Faker;

$factory->define(FoodCategory::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'active' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
