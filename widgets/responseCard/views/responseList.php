<?php
/** @var array $responses */

/** @var object $taskInfo */

use yii\helpers\Html;

?>
<?php
if (($taskInfo->status !== (int)
    \app\models\Tasks::STATUS_NEW)&&(Yii::$app->user->can('cancelTask', ['taskId' => $taskInfo->id]))):?>
    <h4 class="head-regular">Ваш исполнитель</h4>
<?php
elseif($responses): ?>
    <h4 class="head-regular">Отклики на задание</h4>
<?php
else:?>
<div style="opacity: 100"></div>
<?php
endif; ?>

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
            <p class="info-text"><span class="current-time"><?= Yii::$app->formatter->asRelativeTime(
                        $response->create_time
                    )
                    ?></span></p>
            <p class="price price--small"><?= $response->price ?></p>
        </div>
        <?php
        if (Yii::$app->user->can('cancelTask', ['taskId' => $taskInfo->id])):?>
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