<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker = Faker\Factory::create('ru_RU');

return [
    'create_date' =>$faker->dateTimeBetween('2022-04-01', 'now')->format('Y-m-d H:i:s'),
    'email' => $faker->unique()->email(),
    'login' => $faker->sentence($nbWords = 1, $variableNbWords = true),
    'password' => $faker->password(),
    'avatar_file_id' => $faker->numberBetween(1,2),
    'contact_telegram' => $faker->sentence($nbWords = 1, $variableNbWords = true),
    'contact_phone' => $faker->unique()->e164phoneNumber(1, 9),
    'city_id' => $faker->numberBetween(1,1087),
    'birthday' => $faker->dateTimeBetween('1988-04-01', '2010-04-01')->format('Y-m-d H:i:s'),
    'info' => $faker->realTextBetween($minNbChars = 160, $maxNbChars = 200, $indexSize = 2),
    'rating' => $faker->numberBetween(1,2000),
    'status' => $faker->numberBetween(1,4),
    'is_executor' => $faker->boolean(),

];