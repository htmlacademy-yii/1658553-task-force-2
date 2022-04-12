<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker = Faker\Factory::create('ru_RU');

return [
    'executor_id' => $faker->numberBetween(1, 20),
    'customer_id' => $faker->numberBetween(1, 20),
    'task_id' => $faker->numberBetween(100, 10),
    'score' => $faker->numberBetween(1, 100),
    'comment' => $faker->sentence($nbWords = 5, $variableNbWords = true),
    'create_time' => $faker->dateTimeBetween('2022-04-01', 'now')->format('Y-m-d H:i:s'),
];