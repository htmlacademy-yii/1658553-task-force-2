<?php
/* @var $this yii\web\View */

/* @var object $userInfo */
/* @var array $successFailCount */

use yii\helpers\Html;

?>
<main class="main-content container">
    <div class="left-column">
        <h3 class="head-main"><?= $userInfo->login ?></h3>
        <div class="user-card">
            <div class="photo-rate">
                <img class="card-photo" src="<?= $userInfo->file->path ?>" width="191" height="190" alt="Фото
                пользователя">
                <div class="card-rate">
                    <div class="stars-rating big"><span class="fill-star">&nbsp;</span><span
                                class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span
                                class="fill-star">&nbsp;</span><span>&nbsp;</span></div>
                    <span class="current-rate"><?= $userInfo->rating ?></span>
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
                    <?php
                    foreach ($userInfo->userCategories as $userCategories): ?>
                        <li class="special-item">
                            <a href="#" class="link link--regular"><?= $userCategories->category->name ?></a>
                        </li>
                    <?php
                    endforeach; ?>

                </ul>
            </div>
            <div class="bio">
                <p class="head-info">Био</p>
                <p class="bio-info"><span class="country-info">Россия</span>, <span
                            class="town-info"><?= $userInfo->city->name ?></span>,
                    <span class="age-info">30</span> лет</p><?= $userInfo->birthday ?>
            </div>
        </div>
        <h4 class="head-regular">Отзывы заказчиков</h4>
        <?php
        foreach ($userInfo->reviews as $userReviews): ?>

            <div class="response-card">
                <img class="customer-photo" src="<?= $userReviews->users->file->path ?>" width="120"
                     height="127"
                     alt="Фото заказчиков">
                <div class="feedback-wrapper">
                    <p class="feedback"><?= $userReviews->comment ?></p>
                    <p class="task">Задание «<?= Html::a($userReviews->tasks->name, ['/tasks/view/','id'=>$userReviews->tasks
                            ->id],
                            ['class'=>'link link--small'])?>»
                        выполнено</p>
                </div>
                <div class="feedback-wrapper">
                    <div class="stars-rating small"><span class="fill-star">&nbsp;</span><span
                                class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span
                                class="fill-star">&nbsp;</span><span>&nbsp;</span>
                    </div>
                    <p class="info-text"><span class="current-time">25 минут </span>назад</p>
                </div>
            </div>
        <?php
        endforeach; ?>
    </div>
    <div class="right-column">
        <div class="right-card black">
            <h4 class="head-card">Статистика исполнителя</h4>
            <dl class="black-list">
                <dt>Всего заказов</dt>
                <dd><?=$successFailCount['success']?> выполнено, <?=$successFailCount['fail']?> провалено</dd>
                <dt>Место в рейтинге</dt>
                <dd><?= $userInfo->rating ?></dd>
                <dt>Дата регистрации</dt>
                <dd><?= Yii::$app->formatter->asDate($userInfo->create_date) ?></dd>
                <dt>Статус</dt>
                <dd><?= $userInfo->status ?></dd>
            </dl>
        </div>
        <div class="right-card white">
            <h4 class="head-card">Контакты</h4>
            <ul class="enumeration-list">
                <?php if ($userInfo->contact_phone):?>
                <li class="enumeration-item">
                    <a href="#" class="link link--block link--phone"><?= $userInfo->contact_phone ?></a>
                </li>
                <?php endif;?>
                <li class="enumeration-item">
                    <a href="#" class="link link--block link--email"><?= $userInfo->email ?></a>
                </li>
                <?php if ($userInfo->contact_telegram):?>
                <li class="enumeration-item">
                    <a href="#" class="link link--block link--tg">@<?= $userInfo->contact_telegram ?></a>
                </li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</main>