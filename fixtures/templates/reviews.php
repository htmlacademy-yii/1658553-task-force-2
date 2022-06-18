<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker = Faker\Factory::create('ru_RU');

return [
    'executor_id' => $faker->numberBetween(1, 20),
    'customer_id' => $faker->numberBetween(1, 20),
    'task_id' => $faker->numberBetween(1, 10),
    'score' => $faker->numberBetween(1, 5),
    'comment' => $faker->sentence($nbWords = 5, $variableNbWords = true),
    'create_time' => $faker->dateTimeBetween('2022-04-01', date('Y-m-d'))->format('Y-m-d H:i:s'),
];