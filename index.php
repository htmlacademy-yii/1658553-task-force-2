<?php
require_once __DIR__ . '/vendor/autoload.php';
use classes\bus\Task;


/**
 * Своеборазный тестовый сценарий, удалю его к следующему заданию.
 */
$task = new Task(1,2);
var_dump($task);
