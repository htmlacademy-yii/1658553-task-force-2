<?php

/* @var object $addTaskForm */

/* @var object $model */

use yii\widgets\ActiveForm;


?>
<main class="main-content main-content--center container">
    <div class="add-task-form regular-form">

        <?php
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($addTaskForm, 'name')->textInput()
        ?>
        <?= $form->field($addTaskForm, 'info')->textarea()
        ?>
        <?= $form->field($addTaskForm, 'category_id')->dropDownList(\app\models\forms\AddTaskForm::getCategory())
        ?>
        <?= $form->field($addTaskForm, 'city_id')->dropDownList(\app\models\forms\AddTaskForm::getCities())
        ?>
        <div class="half-wrapper">
            <?= $form->field($addTaskForm, 'price')->textInput()
            ?>
            <?= $form->field($addTaskForm, 'deadline_time')->textInput(['type' => 'date'])
            ?>
        </div>
        <?= $form->field($addTaskForm, 'files[]')->fileInput(['multiple' => true]) ?>
        <?= \yii\helpers\Html::submitButton('опубликовать', ['class' => 'button button--blue']); ?>
        <?php
        ActiveForm::end(); ?>


    </div>

</main>