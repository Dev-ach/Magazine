<?php

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        "titre" => $faker->name,
        "contenue" => $faker->name,
        "categories_id" => factory('App\Category')->create(),
        "publier" => 0,
        "redacteur_id" => factory('App\User')->create(),
    ];
});
