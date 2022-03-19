<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'create_time'    => $faker->date,
    'deadline_time'   => $faker->date,
    'name'     => $faker->text,
    'info' => $faker->text,
    'category_id'   => $faker->randomNumber(),
    'city_id' => $faker->randomNumber(),
    'price' => $faker->randomNumber(),
    'customer_id' => $faker->randomNumber(),
    'executor_id' => $faker->randomNumber(),
    'status' => $faker->boolean

];
