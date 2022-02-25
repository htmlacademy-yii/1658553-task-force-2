<?php

require_once __DIR__.'/vendor/autoload.php';

use taskforce\models\Task;

/**
 * файл  тестов для браузера
 */

$test = new Task('done',1,2);
var_dump($test->status);









