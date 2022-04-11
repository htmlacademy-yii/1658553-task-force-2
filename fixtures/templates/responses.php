<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker = Faker\Factory::create('ru_RU');

return [
    'task_id' => $faker->numberBetween(1, 10),
    'executor_id' => $faker->numberBetween(1, 20),
    'price' => $faker->numberBetween(100, 10000),
    'comment' => $faker->sentence($nbWords = 5, $variableNbWords = true),
    'rejected' => $faker->boolean(),
    'create_time' => $faker->dateTimeBetween('2022-04-01', 'now')->format('Y-m-d H:i:s'),
];