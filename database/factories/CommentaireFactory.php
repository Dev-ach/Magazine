<?php

$factory->define(App\Commentaire::class, function (Faker\Generator $faker) {
    return [
        "pseudo" => $faker->name,
        "email" => $faker->safeEmail,
        "commentaire" => $faker->name,
        "valider" => 0,
        "article_id" => factory('App\Article')->create(),
    ];
});
