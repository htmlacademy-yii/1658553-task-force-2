<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker = Faker\Factory::create('ru_RU');
return [

    'category_id' => $faker->numberBetween(1,8),
    'user_id' => $faker->numberBetween(1, 20),

];