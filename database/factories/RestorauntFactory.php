<?php

use Faker\Generator as Faker;

$factory->define(App\Restoraunt::class, function (Faker $faker) {
  return [
      'brand' => $faker->company(),
      'description' => $faker->paragraph(3),
      'email' => $faker->companyEmail(),
      'phone' => $faker->phoneNumber,
      'address' => $faker->address(),
      'rate' => $faker->randomFloat(1, 1, 5),
  ];
});
