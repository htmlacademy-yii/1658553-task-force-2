<?php

use yii\helpers\Html;
/** @var object $user */
?>
<div class="user-block">
    <a href="#">
        <img class="user-photo" src="<?= $user->file->path ?>" width="55" height="55"
             alt="Аватар">
    </a>
    <div class="user-menu">
        <p class="user-name"><?= $user->login ?></p>
        <div class="popup-head">
            <ul class="popup-menu">
                <li class="menu-item">
                    <a href="#" class="link">Настройки</a>
                </li>
                <li class="menu-item">
                    <a href="#" class="link">Связаться с нами</a>
                </li>
                <li class="menu-item">

                    <?= Html::a('Выход из системы', ['/exit/logout'], ['class' => 'link']) ?>
                </li>
            </ul>
        </div>
    </div>
</div>
