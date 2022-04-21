<?php
/* @var $this yii\web\View */

/* @var object $taskInfo */

/* @var object $taskFilterForm */

use yii\widgets\ActiveForm;


?>
<main class="main-content container">
    <div class="left-column">
        <h3 class="head-main head-task">Новые задания</h3>
        <?php
        foreach ($taskInfo as $task): ?>

            <div class="task-card">
                <div class="header-task">
                    <a href="#" class="link link--block link--big"><?= $task->name ?></a>
                    <p class="price price--task"><?= $task->price ?> ₽</p>
                </div>
                <p class="info-text"><span class="current-time"><?= $task->create_time ?> </span>назад</p>
                <p class="task-text">
                    <?= $task->info ?>
                </p>
                <div class="footer-task">
                    <p class="info-text town-text"><?= $task->city->name ?></p>
                    <p class="info-text category-text">Переводы</p>
                    <a href="#" class="button button--black">Смотреть Задание</a>
                </div>
            </div>
        <?php
        endforeach ?>

        <div class="pagination-wrapper">
            <ul class="pagination-list">
                <li class="pagination-item mark">
                    <a href="#" class="link link--page"></a>
                </li>
                <li class="pagination-item">
                    <a href="#" class="link link--page">1</a>
                </li>
                <li class="pagination-item pagination-item--active">
                    <a href="#" class="link link--page">2</a>
                </li>
                <li class="pagination-item">
                    <a href="#" class="link link--page">3</a>
                </li>
                <li class="pagination-item mark">
                    <a href="#" class="link link--page"></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="right-column">
        <div class="right-card black">
            <div class="search-form">
                <?php
                $form = ActiveForm::begin([
                    'id'          => 'filter-form',
                    'fieldConfig' => [
                        'template'     => "{input}\n{label}",
                        'options'      => ['class' => 'form-group'],
                        'labelOptions' => ['class' => 'control-label'],
                    ],
                ]); ?>
                <h4 class="head-card">Категории</h4>
                <div class="form-group">
                    <div>
                        <?= $form->field($taskFilterForm, 'categoryIds')->checkboxList
                        (
                            \app\models\forms\TaskFilterForm::getCategories(),
                            ['separator'=>'<br>',
                                ]
                        )->label(false) ?>
                    </div>
                    <h4 class="head-card">Дополнительно</h4>
                    <div class="form-group">

                        <?= $form->field($taskFilterForm, 'isNoExecutor')->checkbox(
                            $options = ['checked'=>!($taskFilterForm->isNoExecutor==='IS NOT NULL')],
                            $enclosedByLabel = false
                        )->label('Без исполнителя'); ?>

                        <?= $form->field($taskFilterForm, 'isRemote')->checkbox(
                            $options = ['checked'=>!($taskFilterForm->isRemote === '= 689')],
                            $enclosedByLabel = false

                        )->label('Удаленно'); ?>


                    </div>
                    <h4 class="head-card">Период</h4>
                    <div class="form-group">
                        <?= $form->field($taskFilterForm, 'interval')->dropDownList
                        (
                            \app\models\forms\TaskFilterForm::getInterval()
                        )->label(false) ?>
                    </div>
                    <?= \yii\helpers\Html::submitButton('Искать', ['class' => 'button button--blue']); ?>
                    <?php
                    ActiveForm::end(); ?>
                </div>
            </div>
        </div>
</main>
