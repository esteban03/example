<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 10),
        'title'  => $faker->title(),
        'comment' => $faker->text(),
    ];
});
