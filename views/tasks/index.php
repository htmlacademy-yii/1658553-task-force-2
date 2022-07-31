<?php
/* @var $this yii\web\View */

/* @var object $taskInfo */

/* @var object $taskFilterForm */

/* @var object $pages */

use app\models\forms\TaskFilterForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


?>
<main class="main-content container">
    <?php
    \yii\widgets\Pjax::begin(['timeout' => 3000]); ?>

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
                <p class="info-text"><span class="current-time"><?= Yii::$app->formatter->asRelativeTime(
                            $task->create_time
                        ) ?> </span>назад</p>
                <p class="task-text">
                    <?= $task->info ?>
                </p>
                <div class="footer-task">
                    <p class="info-text town-text"><?= $task->city->name ?></p>
                    <p class="info-text category-text">Переводы</p>
                    <a href="<?=Url::to(['tasks/view','id'=>$task->id])?>" class="button button--black">Смотреть
                        Задание</a>
                </div>
            </div>
        <?php
        endforeach ?>




        <?= \yii\widgets\LinkPager::widget([
            'pagination' => $pages,
            'activePageCssClass' =>
                'pagination-item--active',
            'options' => ['class' => 'pagination-list'],
            'linkOptions' => ['class' => 'link link--page'],
            'linkContainerOptions' => ['class' => 'pagination-item'],
            'prevPageLabel' => false,
            'nextPageLabel' => false,
            'prevPageCssClass' => 'mark',
            'nextPageCssClass' => 'mark',


        ]) ?>

        <?php
        \yii\widgets\Pjax::end(); ?>
    </div>
    <div class="right-column">
        <div class="right-card black">
            <div class="search-form">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'filter-form',
                    'method' => 'GET',
                    'action' => Url::to(['tasks/index']),


                ]); ?>
                <h4 class="head-card">Категории</h4>
                <div class="form-group">
                    <div>


                        <?= $form->field($taskFilterForm, 'categoryIds')->checkboxList
                        (
                            TaskFilterForm::getCategories(),


                            [
                                'separator' => '<br>',
                                'comma-separated' => true,
                                'name'=>'',
                                'item' => function ($index, $label, $name, $checked, $value) {

                                //настраиваем параметры инпута для корректного запроса в бд
                                $name = $value;
                                    foreach (Yii::$app->request->get() as $getParam=>$getValue){
                                        if($getParam === $value & !empty($getValue)){
                                            $checked = 'checked';
                                        }
                                    }
                                $value = $index +1;





                                    return "<label class='checkbox col-md-4' style='font-weight: normal;'><input type='checkbox' {$checked} name='{$name}' value='{$value}'>{$label}</label>";
                                },
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
