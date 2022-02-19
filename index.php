<?php

require_once __DIR__.'/vendor/autoload.php';
use taskforce\models\Task;
use taskforce\models\ActionCancel;
use taskforce\exception;

/**
 * файл для тестов
 */

$test = new Task(1,2);

$test->getNextStatus($test,2);
print $test->status;
$test->getNextStatus($test,1);
print $test->status;


