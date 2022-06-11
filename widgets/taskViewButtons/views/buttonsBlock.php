<?php
/** @var object $taskControl */

/** @var object $responseForm */


use app\widgets\taskViewButtons\actions\ActionCancel;
use app\widgets\taskViewButtons\actions\ActionDone;
use app\widgets\taskViewButtons\actions\ActionRefuse;
use app\widgets\taskViewButtons\actions\ActionRespond;
use app\widgets\taskViewButtons\actions\UserRespond;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php
$taskId = $taskControl->task->id;
if ((new ActionCancel())->isAvailable($taskControl, Yii::$app->user->id)) {
    print Html::a('Отменить задание', ["tasks/cancel/$taskId"], ['class' => 'button button--blue']);
}
if ((new ActionDone())->isAvailable($taskControl, Yii::$app->user->id)) {
    print Html::a('Завершить задание', ["tasks/done/$taskId"], ['class' => 'button button--blue']);
}
if ((new ActionRefuse())->isAvailable($taskControl, Yii::$app->user->id)) {
    print Html::a('Отказаться от задания', ["tasks/refuse/$taskId"], ['class' => 'button button--blue']);
}
if ((new ActionRespond())->isAvailable($taskControl, Yii::$app->user->id)
    && UserRespond::isUserRespond
    (
        $taskControl->task->id,
        Yii::$app->user->id
    )
    && Yii::$app->user->id !==
    $taskControl->customerId
) {
    print Html::submitButton('Откликнуться на задание', ['class' => 'button button--blue', 'id' => 'btnClose']);
}

?>

<section class="modal-response" id="modalResponse">
    <h2>Введите данные</h2>
    <button class="form-modal-close" id="formModalClose" type="button">Закрыть</button>
    <?php
    $form = ActiveForm::begin(); ?>

    <?= $form->field($responseForm, 'price')->textInput() ?>

    <?= $form->field($responseForm, 'comment')->textarea([
        'rows'  => 6,
        'cols'  => 40,
        'style' => 'resize:none',

    ]) ?>
    <?= Html::submitButton('Отправить', ['class' => 'button button--blue']) ?>

    <?php
    $form = ActiveForm::end(); ?>
</section>

