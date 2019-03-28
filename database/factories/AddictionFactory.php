<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Addiction::class, function (Faker $faker) {
    return [
        'application_id' => random_int(1,100),
        'description' => $faker->realText(),
        'file' => 'docs/'.$faker->image($dir = '/home/vagrant/code/hrd/storage/app/public/docs/', $width = 250, $height = 250, null, false)
    ];
});
