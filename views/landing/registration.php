<?php
/* @var object $regForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<main class="container container--registration">
    <div class="center-block">
        <div class="registration-form regular-form">

            <?php
            $form = ActiveForm::begin(); ?>
            <h3 class="head-main head-task">Регистрация нового пользователя</h3>
            <?= $form->field($regForm, 'login')->textInput(['id' => 'username']) ?>
            <div class="half-wrapper">
                <?= $form->field($regForm, 'email',['enableAjaxValidation' => true])->textInput([
                    'id'   => 'email-user',
                    'type' => 'email',
                ]) ?>
                <?= $form->field($regForm, 'city')->dropDownList(\app\models\forms\RegistrationForm::getCities()) ?>
            </div>
            <?= $form->field($regForm, 'password')->passwordInput() ?>
            <?= $form->field($regForm, 'password_repeat')->passwordInput() ?>
            <?= $form->field($regForm, 'isExecutor')->checkbox(
                $options = ['checked' => 'true']
            ) ?>

            <?= Html::submitButton('Создать аккаунт', ['class' => 'button button--blue']) ?>
            <?php
            $form = ActiveForm::end(); ?>

        </div>
    </div>
</main>

