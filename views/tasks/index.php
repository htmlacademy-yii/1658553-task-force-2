<?php
/* @var $this yii\web\View */

/* @var object $taskInfo */

/* @var object $taskFilterForm */

/* @var object $pages */

use app\models\forms\TaskFilterForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>
<main class="main-content container">
    <div class="left-column">
        <h3 class="head-main head-task">Новые задания</h3>
        <?php
        foreach ($taskInfo as $task): ?>
            <div class="task-card">
                <div class="header-task">
                    <?= Html::a($task->name, ['/tasks/view', 'id' => $task->id], [
                        'class' => 'link link--block 
                    link--big',
                    ]) ?>
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


        <?php if ($pages->getPageCount() > 1) : ?>
            <div class="pagination-wrapper">
                <ul class="pagination-list">
                    <li class="pagination-item mark">
                        <a class="link link--page"
                           href=<?= '/tasks/' . ($pages->getPage() > 0 ? $pages->getPage() : '#') ?>
                        ></a>
                    </li>
                    <?php for ($page = 1; $page <= $pages->getPageCount(); $page++) : ?>
                        <li class="pagination-item
                    <?= ($page === $pages->getPage() + 1) ? 'pagination-item--active' : '' ?>">
                            <a class="link link--page" href=<?= '/tasks/' . $page ?>><?= $page ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="pagination-item mark">
                        <a class="link link--page href=<?= '/tasks/' .
                        ($pages->getPage() < $pages->getPageCount() - 1 ? $pages->getPage() + 2 : '#') ?>
                           "></a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <div class="right-column">
        <div class="right-card black">
            <div class="search-form">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'filter-form',
                    'fieldConfig' => [
                        'template' => "{input}\n{label}",
                        'options' => ['class' => 'form-group'],
                        'labelOptions' => ['class' => 'control-label'],
                    ],
                ]); ?>
                <h4 class="head-card">Категории</h4>
                <div class="form-group">
                    <div>
                        <?= $form->field($taskFilterForm, 'categoryIds')->checkboxList
                        (
                            TaskFilterForm::getCategories(),
                            [
                                'separator' => '<br>',
                                'checked' => true,
                            ]
                        )->label(false) ?>
                    </div>
                    <h4 class="head-card">Дополнительно</h4>
                    <div class="form-group">

                        <?= $form->field($taskFilterForm, 'isNoExecutor')->checkbox(
                            $options = ['checked' => !empty($taskFilterForm->isNoExecutor)],
                            $enclosedByLabel = false
                        )->label('Без исполнителя'); ?>

                        <?= $form->field($taskFilterForm, 'isRemote')->checkbox(
                            $options = ['checked' => !empty($taskFilterForm->isRemote)],
                            $enclosedByLabel = false

                        )->label('Удаленно'); ?>


                    </div>
                    <h4 class="head-card">Период</h4>
                    <div class="form-group">
                        <?= $form->field($taskFilterForm, 'interval')->dropDownList
                        (
                            TaskFilterForm::getInterval()
                        )->label(false) ?>
                    </div>
                    <?= Html::submitButton('Искать', ['class' => 'button button--blue']); ?>
                    <?php
                    ActiveForm::end(); ?>
                </div>
            </div>
        </div>
</main>
