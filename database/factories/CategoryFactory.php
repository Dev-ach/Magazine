<?php

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        "categorie" => $faker->name,
    ];
});
