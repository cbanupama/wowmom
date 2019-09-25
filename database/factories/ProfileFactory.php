<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'date_of_birth' => $faker->word,
        'due_date' => $faker->word,
        'last_period_date' => $faker->word,
        'phone' => $faker->word,
        'photo' => $faker->word,
        'gender' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
