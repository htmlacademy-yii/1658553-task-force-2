<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<h1>HELLO WORLD</h1>

<?php
$test = new \app\models\Cities();
var_dump($test->findOne(["name"=>"Тольятти"]));;

?>
