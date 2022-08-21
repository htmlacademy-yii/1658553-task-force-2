<?php
/* @var object $chooseRoleForm */

use yii\widgets\ActiveForm;

?>

<main class="main-content main-content--left container">
    <div class="my-profile-form">
        <div class="half-wrapper">
            <?php
            $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <?= $form->field($chooseRoleForm, 'role')->radioList([
                0 => 'исполнитель',
                1 => 'заказчик',
            ])->label('Выберете свою роль') ?>

            <?= \yii\helpers\Html::submitButton('сохранить', ['class' => 'button button--blue']) ?>
            <?php
            ActiveForm::end(); ?>
        </div>
    </div>
</main>
