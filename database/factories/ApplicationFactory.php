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
        'status' => $status,
        'description' => $description,
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