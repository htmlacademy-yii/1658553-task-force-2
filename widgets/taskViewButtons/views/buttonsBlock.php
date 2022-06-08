<?php
/** @var object $taskControl */
use yii\helpers\Html;
var_dump($taskControl->getNextStatus());
?>

<?= Html::a('Откликнуться на задание', ['controller/action'], ['class' => 'button button--blue']) ?>