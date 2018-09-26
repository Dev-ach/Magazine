<?php

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        "tag" => $faker->name,
    ];
});
