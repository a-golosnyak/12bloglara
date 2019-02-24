<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory('App\User')->create()->id;
        },
        'category_id' => function(){
            return factory('App\Category')->create()->id();
        },
        'title' => $faker->words,
        'intro' => $faker->sentence,
        'img' => "/images/posts/2018-11-19_143430_Kak_s_79.jpg",
        'body' => $faker->paragraph,
    ];
});
