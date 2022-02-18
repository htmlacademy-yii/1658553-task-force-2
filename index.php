<?php

require_once __DIR__.'/vendor/autoload.php';
use taskforce\models\Task;
use taskforce\models\ActionCancel;

/**
 * файл для тестов
 */

$test = new Task(1,2);
var_dump($test->getActionMap()[0]->isAvailable($test,1));


