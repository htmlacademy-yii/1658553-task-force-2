<?php

require_once __DIR__.'/vendor/autoload.php';

use taskforce\models\Task;
use taskforce\parsing\AbstractParsingToSql;

/**
 * файл  тестов для браузера
 */

$test = new \taskforce\parsing\ParsingCitySql('cities');
$test->copyToSql();
$test1 = new \taskforce\parsing\ParsingCategoriesToSql('categories');
$test1->copyToSql();
var_dump($test1);






















