<?php

require_once __DIR__.'/vendor/autoload.php';

use taskforce\models\Task;
use PHPUnit\Framework\TestCase;
use taskforce\exception;

/**
 * файл  тестов для браузера
 */

$test = new Task(1, 2);

$status = $test->getNextStatus($test, 1);

