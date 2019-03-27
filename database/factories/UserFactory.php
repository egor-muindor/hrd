<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(\App\Models\User::class, function (Faker $faker) {
    return [
        'name' => 'Muindor',
        'email' => 'qwer@qwer.ru',
        'email_verified_at' => now(),
        'password' => '$2y$10$EnJoabyvLO8UGTuqrHxHPufOpg0ZPXSAFB22yKCd1aLGgGHMSE4sS', // password
        'remember_token' => '4VscQNcXaSODzPHlL12XuQs05F0yJdFfNBspQenQGxe4hNp8IIc2dUBr9bb2',
    ];
});
