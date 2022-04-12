<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker = Faker\Factory::create('ru_RU');

return [
    'path' => $faker->sentence($nbWords = 2, $variableNbWords = true),
];