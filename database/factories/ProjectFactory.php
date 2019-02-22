<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        "title"=>$faker->sentence,
        "description"=>$faker->paragraph,
        "notes"=>$faker->paragraph,
        "user_id"=>factory(App\User::class),
    ];
});
