<?php
/* @var object $changePasswordForm */
/* @var object $user */


use yii\widgets\ActiveForm;

?>

<main class="main-content main-content--left container">
    <div class="left-menu left-menu--edit">
        <h3 class="head-main head-task">Настройки</h3>
        <ul class="side-menu-list">
            <li class="side-menu-item">
                <a href="<?= \yii\helpers\Url::to(['user/settings']) ?>" class="link link--nav">Мой профиль</a>
            </li>
            <li class="side-menu-item side-menu-item--active">
                <a href="#" class="link link--nav">Безопасность</a>
            </li>
            <li class="side-menu-item">
                <a href="#" class="link link--nav">Уведомления</a>
            </li>
        </ul>
    </div>
    <div class="my-profile-form">
        <div class="half-wrapper">
            <?php
            $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <?php if ($user->password): ?>
            <?= $form->field($changePasswordForm, 'oldPassword')->textInput(['type' => 'password'])->label('Старый 
            пароль') ?>
            <?php endif; ?>

            <?= $form->field($changePasswordForm, 'newPassword')->textInput(['type' => 'password'])->label('Новый 
            пароль') ?>
            <?= $form->field($changePasswordForm, 'newPasswordRepeat')->textInput(['type' => 'password'])->label
            ('Повторите новый пароль') ?>

            <?= \yii\helpers\Html::submitButton('сохранить', ['class' => 'button button--blue']) ?>
            <?php
            ActiveForm::end(); ?>
        </div>

    </div>
</main>