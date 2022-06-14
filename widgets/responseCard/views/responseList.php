<?php
/** @var array $responses */

/** @var object $taskInfo */

use app\widgets\taskViewButtons\actions\AccessButtonsControl;
use yii\helpers\Html;

?>
<?php
if (($taskInfo->customer_id === Yii::$app->user->id
    && (string)$taskInfo->status !==
    accessButtonsControl::STATUS_NEW)
): ?>
    <h4 class="head-regular">Ваш исполнитель</h4>
     <?php else: ?>
    <h4 class="head-regular">Отклики на задание</h4>
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
            <p class="info-text"><span class="current-time"><?= Yii::$app->formatter->asRelativeTime($response->create_time)
                    ?></span></p>
            <p class="price price--small"><?= $response->price ?></p>
        </div>
        <?php
        if ($taskInfo->customer_id === Yii::$app->user->id
            && (string)$taskInfo->status ===
            accessButtonsControl::STATUS_NEW
        ): ?>
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
        <?php endif;?>
    </div>
<?php
endforeach; ?>