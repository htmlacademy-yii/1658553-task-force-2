<?php
/* @var $this yii\web\View */

/* @var object $userInfo */


?>
<main class="main-content container">
    <div class="left-column">
        <h3 class="head-main"><?= $userInfo->login ?></h3>
        <div class="user-card">
            <div class="photo-rate">
                <img class="card-photo" src="<?=$userInfo->file->path?>" width="191" height="190" alt="Фото
                пользователя">
                <div class="card-rate">
                    <div class="stars-rating big"><span class="fill-star">&nbsp;</span><span
                                class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span
                                class="fill-star">&nbsp;</span><span>&nbsp;</span></div>
                    <span class="current-rate"><?=$userInfo->rating?>></span>
                </div>
            </div>
            <p class="user-description">
                <?= $userInfo->info ?>
            </p>
        </div>
        <div class="specialization-bio">
            <div class="specialization">
                <p class="head-info">Специализации</p>
                <ul class="special-list">
                    <li class="special-item">
                        <a href="#" class="link link--regular">Ремонт бытовой техники</a>
                    </li>
                    <li class="special-item">
                        <a href="#" class="link link--regular">Курьер</a>
                    </li>
                    <li class="special-item">
                        <a href="#" class="link link--regular">Оператор ПК</a>
                    </li>
                </ul>
            </div>
            <div class="bio">
                <p class="head-info">Био</p>
                <p class="bio-info"><span class="country-info">Россия</span>, <span
                            class="town-info"><?=$userInfo->city->name?></span>,
                    <span class="age-info">30</span> лет</p><?=$userInfo->birthday?>
            </div>
        </div>
        <h4 class="head-regular">Отзывы заказчиков</h4>
        <div class="response-card">
            <img class="customer-photo" src="../img/man-coat.png" width="120" height="127" alt="Фото заказчиков">
            <div class="feedback-wrapper">
                <p class="feedback">«Кумар сделал всё в лучшем виде. Буду обращаться к нему в
                    будущем, если возникнет такая необходимость!»</p>
                <p class="task">Задание «<a href="#" class="link link--small">Повесить полочку</a>» выполнено</p>
            </div>
            <div class="feedback-wrapper">
                <div class="stars-rating small"><span class="fill-star">&nbsp;</span><span
                            class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span>&nbsp;</span>
                </div>
                <p class="info-text"><span class="current-time">25 минут </span>назад</p>
            </div>
        </div>
        <div class="response-card">
            <img class="customer-photo" src="../img/man-sweater.png" width="120" height="127" alt="Фото заказчиков">
            <div class="feedback-wrapper">
                <p class="feedback">«Кумар сделал всё в лучшем виде. Буду обращаться к нему в
                    будущем, если возникнет такая необходимость!»</p>
                <p class="task">Задание «<a href="#" class="link link--small">Повесить полочку</a>» выполнено</p>
            </div>
            <div class="feedback-wrapper">
                <div class="stars-rating small"><span class="fill-star">&nbsp;</span><span
                            class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span>&nbsp;</span>
                </div>
                <p class="info-text"><span class="current-time">25 минут </span>назад</p>
            </div>
        </div>
    </div>
    <div class="right-column">
        <div class="right-card black">
            <h4 class="head-card">Статистика исполнителя</h4>
            <dl class="black-list">
                <dt>Всего заказов</dt>
                <dd>4 выполнено, 0 провалено</dd>
                <dt>Место в рейтинге</dt>
                <dd><?=$userInfo->rating?></dd>
                <dt>Дата регистрации</dt>
                <dd><?=$userInfo->create_date?></dd>
                <dt>Статус</dt>
                <dd><?=$userInfo->status?></dd>
            </dl>
        </div>
        <div class="right-card white">
            <h4 class="head-card">Контакты</h4>
            <ul class="enumeration-list">
                <li class="enumeration-item">
                    <a href="#" class="link link--block link--phone"><?=$userInfo->contact_phone?></a>
                </li>
                <li class="enumeration-item">
                    <a href="#" class="link link--block link--email"><?=$userInfo->email?></a>
                </li>
                <li class="enumeration-item">
                    <a href="#" class="link link--block link--tg">@<?=$userInfo->contact_telegram?></a>
                </li>
            </ul>
        </div>
    </div>
</main>