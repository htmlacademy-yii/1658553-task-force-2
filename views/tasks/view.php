<?php
/* @var $this yii\web\View */

/* @var object $taskInfo */

/* @var object $taskFiles */

use app\widgets\taskViewButtons\buttonsBlock;
use app\widgets\taskFiles\fileCard;
use yii\helpers\Html;

?>

<main class="main-content container">

    <div class="left-column">
        <div class="head-wrapper">
            <h3 class="head-main"><?= $taskInfo->name ?></h3>
            <p class="price price--big"><?= $taskInfo->price ?> ₽</p>
        </div>
        <p class="task-description">
            <?= $taskInfo->info ?></p>
        <?= buttonsBlock::widget(['taskId'=>$taskInfo->id]) ?>


        <!--        <div class="task-map">-->
        <!--            <img class="map" src="../img/map.png" width="725" height="346" alt="Новый арбат, 23, к. 1">-->
        <!--            <p class="map-address town">Москва</p>-->
        <!--            <p class="map-address">Новый арбат, 23, к. 1</p>-->
        <!--        </div>-->

        <h4 class="head-regular">Отклики на задание</h4>
        <?php
        foreach ($taskInfo->responses as $responses): ?>
            <div class="response-card">

                <img class="customer-photo" src="<?= $responses->executor->file->path ?>" width="146" height="156" alt="Фото
            заказчиков">

                <div class="feedback-wrapper">
                    <?= Html::a($responses->executor->login, ['/user/view', 'id' => $responses->executor_id], [
                        'class' => 'link link--block
                link--big',
                    ]) ?>
                    <div class="response-wrapper">
                        <div class="stars-rating small"><span class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span
                                    class="fill-star">&nbsp;</span><span
                                    class="fill-star">&nbsp;</span><span>&nbsp;</span></div>
                        <p class="reviews"> <?= count($responses->executor->reviews) ?> отзыва</p>
                    </div>
                    <p class="response-message">
                        <?= $responses->comment ?>
                    </p>

                </div>
                <div class="feedback-wrapper">
                    <p class="info-text"><span class="current-time"><?= $responses->create_time ?></span>назад</p>
                    <p class="price price--small"><?= $responses->price ?></p>
                </div>
                <div class="button-popup">
                    <a href="#" class="button button--blue button--small">Принять</a>
                    <a href="#" class="button button--orange button--small">Отказать</a>
                </div>
            </div>
        <?php
        endforeach; ?>
    </div>
    <div class="right-column">
        <div class="right-card black info-card">
            <h4 class="head-card">Информация о задании</h4>
            <dl class="black-list">
                <dt>Категория</dt>
                <dd><?= $taskInfo->category->name ?></dd>
                <dt>Дата публикации</dt>
                <dd><?= $taskInfo->create_time ?></dd>
                <dt>Срок выполнения</dt>
                <dd><?= $taskInfo->deadline_time ?></dd>
                <dt>Статус</dt>
                <dd><?= \app\models\Tasks::getStatusLabel($taskInfo->status) ?></dd>
            </dl>
        </div>
        <?=fileCard::widget(['taskId'=>$taskInfo->id])?>
    </div>
</main>

