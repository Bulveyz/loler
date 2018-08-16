<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
  $caegories = ['Dessert', 'Hot dish', 'Drinks', 'Liquid dishes', 'Salad'];
  return [
      'category' => $caegories[rand(0, 4)]
  ];
});
