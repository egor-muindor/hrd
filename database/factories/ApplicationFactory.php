<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Application::class, function (Faker $faker) {
    $first_name = $faker->firstName();
    $middle_name = $faker->domainWord();
    $last_name = $faker->lastName();
    $status = (random_int(1,10) > 6) ? random_int(1,2):0;
    $description = ($status !== 0) ? $faker->realText() : null;

    $data = [
        'first_name' => $first_name,
        'middle_name' => $middle_name,
        'last_name' => $last_name,
        'description' => $description,
        'email' => $faker->email(),
        'status' => $status,
        'passport_id' => random_int(1000, 9999).' '.random_int(100000, 999999), // faker сломался ну или я тупенький >_<
        'employment_history' => $faker->realText(),
        'snils' => random_int(100, 999) . '-' . random_int(100, 999) . '-' . random_int(100, 999) . '-' . random_int(10, 99),
        'inn' => '' . random_int(1000000000, 9999999999),
        'created_at' => $faker->dateTimeBetween('-2 month', '-7 days'),
        'post_id' => random_int(1,40),
        'scientific_works' => $faker->realText(),

    ];

    return $data;
});

//$table->bigIncrements('id');
//$table->text('first_name');
//$table->text('middle_name');
//$table->text('last_name');
//$table->smallInteger('status');
//$table->mediumText('description');
//
//$table->timestamps();
//$table->softDeletes();