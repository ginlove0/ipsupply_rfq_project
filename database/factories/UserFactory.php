<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    static $password;
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'company_name' => $faker->company,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => $password ?: $password = bcrypt('secret'), // password
        'status' => (bool)random_int(0, 1),
        'is_admin' => (bool)random_int(0, 1),
        'meta' => [
            'group' => $faker->randomElements(['group-au', 'group-us', 'group-cn'], rand(1,3))
        ],
        'remember_token' => Str::random(10),
    ];
});
