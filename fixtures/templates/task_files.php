<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker = Faker\Factory::create('ru_RU');

return [
    'task_id' => $faker->numberBetween(1, 20),
    'file_id' => $faker->numberBetween(1, 2),

];