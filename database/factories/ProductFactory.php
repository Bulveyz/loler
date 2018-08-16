<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
  return [
      'title' => $faker->sentence(3),
      'category_id' => rand(1, 5),
      'restoraunt_id' => function () {
        return factory('App\Restoraunt')->create()->id;
      },
      'image' => 'assets/images/food/image' . rand(1, 20) . '.jpg',
      'description' => $faker->paragraph(3),
      'rate' => $faker->randomFloat(1, 1, 5),
      'price' => $faker->numberBetween(10, 120),
  ];
});
