<?php

/** @var yii\web\View $this */

/** @var string $content */


use app\assets\AppAsset;
use app\models\Users;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

use app\widgets\navigationBar\userBlock;


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


<header class="page-header">
    <nav class="main-nav">
        <a href='#' class="header-logo">
            <img class="logo-image" src="/img/logotype.png" width=227 height=60 alt="taskforce">
        </a>
        <div class="nav-wrapper">
            <ul class="nav-list">
                <li class="list-item list-item--active">
                    <a class="link link--nav">Новое</a>
                </li>
                <li class="list-item">
                    <a href="#" class="link link--nav">Мои задания</a>
                </li>
                <li class="list-item">
                    <?= Html::a('Создать задание', ['tasks/add'], ['class' => 'link link--nav']) ?>
                </li>
                <li class="list-item">
                    <a href="#" class="link link--nav">Настройки</a>
                </li>
            </ul>
        </div>
    </nav>

   <?= userBlock::widget()?>
</header>


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
