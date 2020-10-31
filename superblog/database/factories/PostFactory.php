<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'cat_id' => random_int(1, 10),
        'user_id' => random_int(1, 10),
        'comment_id' => random_int(1, 10),
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'photo' => $faker->word,

    ];
});
