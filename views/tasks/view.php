<?php
/* @var $this yii\web\View */

/* @var object $taskInfo */

/* @var object $taskFiles */
/* @var object $responses */

/* @var object $responseForm */
/* @var object $doneForm */

use app\widgets\responseCard\responseBlock;
use app\widgets\taskFiles\fileCard;
use app\widgets\taskViewButtons\buttonsBlock;
use yii\helpers\Html;
use app\models\Tasks;


?>

<main class="main-content container">

    <div class="left-column">
        <div class="head-wrapper">
            <h3 class="head-main"><?= $taskInfo->name ?></h3>
            <p class="price price--big"><?= $taskInfo->price ?> ₽</p>
        </div>
        <p class="task-description">
            <?= $taskInfo->info ?></p>
        <?= buttonsBlock::widget(['taskId' => $taskInfo->id, 'responseForm' => $responseForm,'doneForm'=>$doneForm]) ?>


        <!--        <div class="task-map">-->
        <!--            <img class="map" src="../img/map.png" width="725" height="346" alt="Новый арбат, 23, к. 1">-->
        <!--            <p class="map-address town">Москва</p>-->
        <!--            <p class="map-address">Новый арбат, 23, к. 1</p>-->
        <!--        </div>-->


        <?=responseBlock::widget(['responses'=>$responses,'taskInfo' => $taskInfo])?>
    </div>
    <div class="right-column">
        <div class="right-card black info-card">
            <h4 class="head-card">Информация о задании</h4>
            <dl class="black-list">
                <dt>Категория</dt>
                <dd><?= $taskInfo->category->name ?></dd>
                <dt>Дата публикации</dt>

                <dd><?= Yii::$app->formatter->asDate($taskInfo->create_time) ?></dd>
                <dt>Срок выполнения</dt>
                <dd><?= Yii::$app->formatter->asDate($taskInfo->deadline_time) ?></dd>
                <dt>Статус</dt>
                <dd><?= Tasks::getStatusLabel($taskInfo->status) ?></dd>
            </dl>
        </div>
        <?= fileCard::widget(['taskId' => $taskInfo->id]) ?>
    </div>

</main>

