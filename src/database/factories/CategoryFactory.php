<?php

use Faker\Generator as Faker;
use HaiCS\Laravel\Api\Response\Test\Stubs\Models\Category;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->words(rand(1, 3), true);
    return [
        'name' => $name,
        'slug' => $name,
    ];
});
