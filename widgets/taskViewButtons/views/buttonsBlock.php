<?php
/** @var object $taskControl */

/** @var object $responseForm */

/** @var object $doneForm */


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
    print Html::submitButton('Завершить задание', ['class' => 'button button--blue', 'id' => 'btnShowDone']);
}
if ((new ActionRefuse())->isAvailable($taskControl, Yii::$app->user->id)) {

    print Html::submitButton('Отказаться от задания', ['class' => 'button button--blue','id'=>'btnShowRefuse']);

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
    print Html::submitButton('Откликнуться на задание', ['class' => 'button button--blue', 'id' => 'btnShowResponse']);
}

?>

<section class="modal-response" id="modalResponse">
    <h2>Введите данные</h2>
    <button class="form-modal-close" id="formModalCloseResponse" type="button">Закрыть</button>
    <?php
    $formResponse = ActiveForm::begin(); ?>

    <?= $formResponse->field($responseForm, 'price')->textInput() ?>

    <?= $formResponse->field($responseForm, 'comment')->textarea([
        'rows'  => 6,
        'cols'  => 40,
        'style' => 'resize:none',

    ]) ?>
    <?= Html::submitButton('Отправить', ['class' => 'button button--blue']) ?>

    <?php
    $formResponse = ActiveForm::end(); ?>
</section>

<section class="modal-done" id="modalDone">
    <h2>Введите данные</h2>
    <button class="form-modal-close" id="formModalCloseDone" type="button">Закрыть</button>
    <?php
    $formDone = ActiveForm::begin(); ?>

    <?= $formDone->field($doneForm, 'score')->radioList($doneForm->radioScore()) ?>

    <?= $formDone->field($doneForm, 'comment')->textarea([
        'rows'  => 6,
        'cols'  => 40,
        'style' => 'resize:none',

    ]) ?>
    <?= Html::submitButton('Отправить', ['class' => 'button button--blue']) ?>

    <?php
    $formDone = ActiveForm::end(); ?>
</section>
<section class="modal-refuse" id="modalRefuse">
    <h2>Введите данные</h2>
    <button class="form-modal-close" id="formModalCloseRefuse" type="button">Закрыть</button>
   <p>Отказ от задания понизит ваш рейтинг</p>

    <?= Html::a('Отказаться от задания', ["tasks/refuse/$taskId"], ['class' => 'button button--blue']); ?>


</section>
