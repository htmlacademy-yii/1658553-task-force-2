<?php
/* @var object $userInfo */

/* @var object $userSettingsForm */

use yii\widgets\ActiveForm;

?>

<main class="main-content main-content--left container">
    <div class="left-menu left-menu--edit">
        <h3 class="head-main head-task">Настройки</h3>
        <ul class="side-menu-list">
            <li class="side-menu-item side-menu-item--active">
                <a class="link link--nav">Мой профиль</a>
            </li>
            <li class="side-menu-item">
                <a href="<?=\yii\helpers\Url::to(['user/change-pass'])?>" class="link link--nav">Безопасность</a>
            </li>
            <li class="side-menu-item">
                <a href="#" class="link link--nav">Уведомления</a>
            </li>
        </ul>
    </div>
    <div class="my-profile-form">
        <?php
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
        <h3 class="head-main head-regular">Мой профиль</h3>
        <div class="photo-editing">
            <div>
                <p class="form-label">Аватар</p>
                <img class="avatar-preview" src="<?= $userInfo->file->path ?>" width="83" height="83">
            </div>
            <?= $form->field($userSettingsForm, 'file')->fileInput([
                'multiple' =>
                    false,
                'value'    => 'Сменить Аватар',
                'hidden'   => true,
            ])->label('Сменить Аватар', ['class' => 'button button--black']) ?>
        </div>
        <?= $form->field($userSettingsForm, 'login', ['options' => ['class' => 'form-group']])->textInput
        (
            ['value' => $userInfo->login]
        )
            ->label
            () ?>
        <div class="half-wrapper">
            <?= $form->field($userSettingsForm, 'email', ['options' => ['class' => 'form-group']])->textInput
            (
                [
                    'value' => $userInfo->email,
                    'type'  => 'email',
                ]
            )
                ->label
                () ?>
            <?= $form->field($userSettingsForm, 'birthday', ['options' => ['class' => 'form-group']])->textInput
            (
                [
                    'value'=>date('Y-m-d',strtotime($userInfo->birthday)),
                    'type'  => 'date',
                ]
            )
                ->label
                () ?>
        </div>
        <div class="half-wrapper">
            <?= $form->field($userSettingsForm, 'contact_phone', ['options' => ['class' => 'form-group']])->textInput
            (
                [
                    'value' => $userInfo->contact_phone,
                    'type'  => 'tel',
                ]
            )
                ->label
                () ?>
            <?= $form->field($userSettingsForm, 'contact_telegram', ['options' => ['class' => 'form-group']])->textInput
            (
                [
                    'value'=>$userInfo->contact_telegram,

                ]
            )
                ->label
                () ?>
        </div>
        <?= $form->field($userSettingsForm, 'info', ['options' => ['class' => 'form-group']])->textArea
        (
            [
                'value'=>$userInfo->info,
            ]
        )
            ->label
            () ?>
        <div class="form-group">
        <?= $form->field(
            $userSettingsForm,
            'specialisation',
            ['options' => ['class' => 'checkbox-profile']]
        )->checkboxList(
            \app\models\forms\AddTaskForm::getCategory(),
            [

                'item' => function ($index, $label, $name, $checked, $value) {

                    $return = '<label class="control-label">';

                        if (array_key_exists($value,\app\services\user\UserSpecialisationService::getUserSpecialisations())){
                            $return .= '<input type="checkbox" checked name="'.$name
                                .'" value="'.$value.'" tabindex="3">';
                        } else {
                            $return .= '<input type="checkbox" name="'.$name
                                .'" value="'.$value.'" tabindex="3">';
                        }


                    $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                    $return .= '</label>';


                    return $return;
                },

            ]
        )
            ->label()
        ?>
        </div>


        <?= \yii\helpers\Html::submitButton('сохранить', ['class' => 'button button--blue']) ?>
        <?php
        ActiveForm::end(); ?>

    </div>
</main>