<?php
/* @var $this yii\web\View */

/* @var object $taskInfo */

/* @var object $taskFiles */
/* @var object $responses */

/* @var object $responseForm */

use app\widgets\taskFiles\fileCard;
use app\widgets\taskViewButtons\buttonsBlock;
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
        <?= buttonsBlock::widget(['taskId' => $taskInfo->id, 'responseForm' => $responseForm]) ?>


        <!--        <div class="task-map">-->
        <!--            <img class="map" src="../img/map.png" width="725" height="346" alt="Новый арбат, 23, к. 1">-->
        <!--            <p class="map-address town">Москва</p>-->
        <!--            <p class="map-address">Новый арбат, 23, к. 1</p>-->
        <!--        </div>-->

        <h4 class="head-regular">Отклики на задание</h4>
        <?php
        foreach ($responses as $response): ?>
            <div class="response-card">

                <img class="customer-photo" src="<?= $response->executor->file->path ?>" width="146" height="156" alt="Фото
            заказчиков">

                <div class="feedback-wrapper">
                    <?= Html::a($response->executor->login, ['/user/view', 'id' => $response->executor_id], [
                        'class' => 'link link--block
                link--big',
                    ]) ?>
                    <div class="response-wrapper">
                        <div class="stars-rating small"><span class="fill-star">&nbsp;</span><span
                                    class="fill-star">&nbsp;</span><span
                                    class="fill-star">&nbsp;</span><span
                                    class="fill-star">&nbsp;</span><span>&nbsp;</span></div>
                        <p class="reviews"> <?= count($response->executor->reviews) ?> отзыва</p>
                    </div>
                    <p class="response-message">
                        <?= $response->comment ?>
                    </p>

                </div>

                <div class="feedback-wrapper">
                    <p class="info-text"><span class="current-time"><?= $response->create_time ?></span>назад</p>
                    <p class="price price--small"><?= $response->price ?></p>
                </div>
                <?php
                if ($taskInfo->customer_id === Yii::$app->user->id): ?>
                    <div class="button-popup">
                        <?= Html::a('Принять', [
                            'tasks/rejected',
                            'taskId'     => $taskInfo->id,
                            'executorId' =>
                                $response->executor_id,
                            'isRejected' => false,
                        ], [
                            'class'
                            => 'button button--blue button--small',
                        ]) ?>
                        <?= Html::a('Отказать', [
                            'tasks/rejected',
                            'taskId'     => $taskInfo->id,
                            'executorId' =>
                                $response->executor_id,
                            'isRejected' => true,
                        ], [
                            'class' => 'button button--orange 
                        button--small',
                        ]); ?>
                    </div>
                <?php
                endif; ?>
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

                <dd><?= Yii::$app->formatter->asDate($taskInfo->create_time) ?></dd>
                <dt>Срок выполнения</dt>
                <dd><?= $taskInfo->deadline_time ?></dd>
                <dt>Статус</dt>
                <dd><?= \app\models\Tasks::getStatusLabel($taskInfo->status) ?></dd>
            </dl>
        </div>
        <?= fileCard::widget(['taskId' => $taskInfo->id]) ?>
    </div>

</main>

