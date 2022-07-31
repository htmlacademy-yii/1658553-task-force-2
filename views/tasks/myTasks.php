<?php
/* @var $this yii\web\View */

/* @var object $taskInfo */

/* @var object $pages */

use yii\helpers\Html;
use yii\helpers\Url;


?>

<main class="main-content container">
    <div class="left-menu">
        <h3 class="head-main head-task">Мои задания</h3>
        <ul class="side-menu-list">
            <?php
            if ((new app\models\Users)->getRoleNameStatic(Yii::$app->user->id) === 'employer'): ?>
                <?php
                if ((Yii::$app->request->get('status')) === 'new'): ?>
                    <li class="side-menu-item side-menu-item--active">
                        <a href="<?= Url::to(['tasks/my-tasks', 'status' => 'new']) ?>" class="link link--nav">Новые</a>
                    </li>
                <?php
                else: ?>
                    <li class="side-menu-item">
                        <a href="<?= Url::to(['tasks/my-tasks', 'status' => 'new']) ?>" class="link link--nav">Новые</a>
                    </li>
                <?php
                endif ?>
                <?php
                if ((Yii::$app->request->get('status')) === 'progress'): ?>
                    <li class="side-menu-item side-menu-item--active">
                        <a href="<?= Url::to(['tasks/my-tasks', 'status' => 'progress']) ?>" class="link link--nav">В
                            процессе</a>
                    </li>
                <?php
                else: ?>
                    <li class="side-menu-item">
                        <a href="<?= Url::to(['tasks/my-tasks', 'status' => 'progress']) ?>" class="link link--nav">В
                            процессе</a>
                    </li>
                <?php
                endif ?>

                <?php
                if ((Yii::$app->request->get('status')) === 'closed'): ?>
                    <li class="side-menu-item side-menu-item--active">
                        <a href="<?= Url::to(['tasks/my-tasks', 'status' => 'closed']) ?>"
                           class="link link--nav">Закрытые</a>
                    </li>
                <?php
                else: ?>
                    <li class="side-menu-item">
                        <a href="<?= Url::to(['tasks/my-tasks', 'status' => 'closed']) ?>"
                           class="link link--nav">Закрытые</a>
                    </li>
                <?php
                endif ?>



            <?php
            else: ?>
                <?php
                if ((Yii::$app->request->get('status')) === 'progress'): ?>
                    <li class="side-menu-item side-menu-item--active">
                        <a href="<?= Url::to(['tasks/my-tasks', 'status' => 'progress']) ?>" class="link link--nav">В
                            процессе</a>
                    </li>
                <?php
                else: ?>
                    <li class="side-menu-item ">
                        <a href="<?= Url::to(['tasks/my-tasks', 'status' => 'progress']) ?>" class="link link--nav">В
                            процессе</a>
                    </li>
                <?php
                endif ?>
                <?php
                if ((Yii::$app->request->get('status')) === 'delayed'): ?>
                    <li class="side-menu-item side-menu-item--active">
                        <a href="<?= Url::to(['tasks/my-tasks', 'status' => 'delayed']) ?>" class="link
                    link--nav">Просрочено</a>
                    </li>
                <?php
                else: ?>
                    <li class="side-menu-item">
                        <a href="<?= Url::to(['tasks/my-tasks', 'status' => 'delayed']) ?>" class="link
                    link--nav">Просрочено</a>
                    </li>
                <?php
                endif ?>

                <?php
                if ((Yii::$app->request->get('status')) === 'closed'): ?>
                    <li class="side-menu-item side-menu-item--active">
                        <a href="<?= Url::to(['tasks/my-tasks', 'status' => 'closed']) ?>"
                           class="link link--nav">Закрытые</a>
                    </li>
                <?php
                else: ?>
                    <li class="side-menu-item">
                        <a href="<?= Url::to(['tasks/my-tasks', 'status' => 'closed']) ?>"
                           class="link link--nav">Закрытые</a>
                    </li>
                <?php
                endif ?>

            <?php
            endif; ?>
        </ul>
    </div>
    <div class="left-column left-column--task">
        <h3 class="head-main head-regular">Новые задания</h3>
        <?php
        \yii\widgets\Pjax::begin(['timeout' => 3000]); ?>
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
                    <a href="<?= Url::to(['tasks/view', 'id' => $task->id]) ?>" class="button button--black">Смотреть
                        Задание</a>
                </div>
            </div>
        <?php
        endforeach ?>
        <?= \yii\widgets\LinkPager::widget([
            'pagination'           => $pages,
            'activePageCssClass'   =>
                'pagination-item--active',
            'options'              => ['class' => 'pagination-list'],
            'linkOptions'          => ['class' => 'link link--page'],
            'linkContainerOptions' => ['class' => 'pagination-item'],
            'prevPageLabel'        => false,
            'nextPageLabel'        => false,
            'prevPageCssClass'     => 'mark',
            'nextPageCssClass'     => 'mark',


        ]) ?>

        <?php
        \yii\widgets\Pjax::end(); ?>
    </div>
</main>
