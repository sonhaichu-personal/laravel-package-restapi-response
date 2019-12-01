<?php

use Faker\Generator as Faker;
use HaiCS\Laravel\Api\Response\Test\Stubs\Models\Book;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title'       => $faker->sentence(rand(3, 7)),
        'description' => $faker->sentences(rand(3, 7), true),
        'author'      => $faker->name(),
    ];
});
