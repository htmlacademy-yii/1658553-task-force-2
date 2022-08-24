<?php

/** @var yii\web\View $this */

/** @var string $content */


use app\assets\AppAsset;
use app\widgets\Alert;
use app\widgets\navigationBar\userBlock;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


AppAsset::register($this);


?>
<?php
$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
    $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php
    $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php
$this->beginBody() ?>


<hdoeader class="page-header">
    <nav class="main-nav">
        <a href='#' class="header-logo">
            <img class="logo-image" src="/img/logotype.png" width=227 height=60 alt="taskforce">
        </a>
        <div class="nav-wrapper">
            <ul class="nav-list">
                <li class="list-item <?php
                if (Yii::$app->request->url === \yii\helpers\Url::to(['tasks/index'])) {
                    print 'list-item--active';
                } ?>">
                    <a href="<?=\yii\helpers\Url::to(['tasks/index'])?>" class="link link--nav">Новое</a>
                </li>
                <li class="list-item <?php
                if (Yii::$app->request->url === \yii\helpers\Url::to(['tasks/my-tasks'])) {
                    print 'list-item--active';
                } ?>">
                    <?php if ((new app\models\Users)->getRoleNameStatic(Yii::$app->user->id)==='employer'): ?>
                    <a href="<?=\yii\helpers\Url::to(['tasks/my-tasks','status'=>'new'])?>" class="link
                    link--nav">Мои
                        задания</a>
                    <?php else:?>
                    <a href="<?=\yii\helpers\Url::to(['tasks/my-tasks','status'=>'progress'])?>" class="link
                    link--nav">Мои
                        задания</a>
                    <?php endif;?>
                </li>
<!--                var_dump(Yii::$app->user->id);-->

                <?php if (Yii::$app->user->can('createPost')): ?>
                <li class="list-item <?php
                if (Yii::$app->request->url === \yii\helpers\Url::to(['tasks/add'])) {
                    print 'list-item--active';
                } ?>">
                    <?= Html::a('Создать задание', ['tasks/add'], ['class' => 'link link--nav']) ?>
                </li>
                <?php endif?>
                <li class="list-item <?php
                if (Yii::$app->request->url === \yii\helpers\Url::to(['user/settings'])
                    || Yii::$app->request->url === \yii\helpers\Url::to(['user/change-pass'])
                ) {
                    print 'list-item--active';
                } ?>">
                    <a href="<?= \yii\helpers\Url::to(['user/settings']) ?>" class="link link--nav">Настройки</a>
                </li>
            </ul>
        </div>
    </nav>

    <?= userBlock::widget() ?>
</hdoeader>


<?php
if (empty(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))
    && !(('/'.Yii::$app->controller->id.'/'.
            Yii::$app->controller->action->id) === \yii\helpers\Url::to(['user/role-choose']))
): ?>
    <?php
    return Yii::$app->response->redirect(['user/role-choose']); ?>

<?php
endif ?>

<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<?= Alert::widget() ?>
<?= $content ?>

<div class="overlay" id="overlay"></div>
<?php
$this->endBody() ?>
</body>
</html>
<?php
$this->endPage() ?>
