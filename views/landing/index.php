<?php
/** @var yii\web\View $this */

/** @var object $loginForm */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\authclient\widgets\AuthChoice;

?>

<section class="modal enter-form form-modal" id="enter-form">
    <h2>Вход на сайт</h2>


    <?php
    $form = ActiveForm::begin(['fieldConfig' => ['template' => '{label}{input}'],'options' => ['style'=>'margin-bottom:0']]); ?>

    <?= $form->field($loginForm, 'email',['enableAjaxValidation' => true])->textInput() ?>

    <?= $form->field($loginForm, 'password',['enableAjaxValidation' => true])->passwordInput() ?>
    <?= Html::submitButton('Войти', ['class' => 'button','style'=>'margin-top:10px']) ?>
    <?php
    $form = ActiveForm::end(); ?>
    <div>
        <?php
        $authChoice = AuthChoice::begin([
            'baseAuthUrl' => ['api/social'],
            'options' => [
                'style'=>'width:100%'
            ]
        ]);
        foreach ($authChoice->getClients() as $client) {
            $button = null;
            if ($client->getId() === 'vkontakte'){
                $button = Html::button(
                    '<i class=""">login with vk</i>',
                    [
                        'class'=>' button button--blue',
                        'type' => 'button',
                        'style'=>'margin-right:14px; margin-top:10px'
                    ]
                );
                echo '<noindex>' . $authChoice->clientLink($client,$button,['rel'=>'nofollow']).'</noindex>';
            }
        }
        AuthChoice::end();
        ?>
    </div>





    <button class="form-modal-close" type="button">Закрыть</button>
</section>

<main>
    <div class="landing-container">
        <div class="landing-top">
            <h1>Работа для всех.<br>
                Найди исполнителя на любую задачу.</h1>
            <p>Сломался кран на кухне? Надо отправить документы? Нет времени самому гулять с собакой?
                У нас вы быстро найдёте исполнителя для любой жизненной ситуации?<br>
                Быстро, безопасно и с гарантией. Просто, как раз, два, три. </p>
            <button class="button">Создать аккаунт</button>
        </div>
        <div class="landing-center">
            <div class="landing-instruction">
                <div class="landing-instruction-step">
                    <div class="instruction-circle circle-request"></div>
                    <div class="instruction-description">
                        <h3>Публикация заявки</h3>
                        <p>Создайте новую заявку.</p>
                        <p>Опишите в ней все детали
                            и стоимость работы.</p>
                    </div>
                </div>
                <div class="landing-instruction-step">
                    <div class="instruction-circle  circle-choice"></div>
                    <div class="instruction-description">
                        <h3>Выбор исполнителя</h3>
                        <p>Получайте отклики от мастеров.</p>
                        <p>Выберите подходящего<br>
                            вам исполнителя.</p>
                    </div>
                </div>
                <div class="landing-instruction-step">
                    <div class="instruction-circle  circle-discussion"></div>
                    <div class="instruction-description">
                        <h3>Обсуждение деталей</h3>
                        <p>Обсудите все детали работы<br>
                            в нашем внутреннем чате.</p>
                    </div>
                </div>
                <div class="landing-instruction-step">
                    <div class="instruction-circle circle-payment"></div>
                    <div class="instruction-description">
                        <h3>Оплата&nbsp;работы</h3>
                        <p>По завершении работы оплатите
                            услугу и закройте задание</p>
                    </div>
                </div>
            </div>
            <div class="landing-notice">
                <div class="landing-notice-card card-executor">
                    <h3>Исполнителям</h3>
                    <ul class="notice-card-list">
                        <li>
                            Большой выбор заданий
                        </li>
                        <li>
                            Работайте где удобно
                        </li>
                        <li>
                            Свободный график
                        </li>
                        <li>
                            Удалённая работа
                        </li>
                        <li>
                            Гарантия оплаты
                        </li>
                    </ul>
                </div>
                <div class="landing-notice-card card-customer">
                    <h3>Заказчикам</h3>
                    <ul class="notice-card-list">
                        <li>
                            Исполнители на любую задачу
                        </li>
                        <li>
                            Достоверные отзывы
                        </li>
                        <li>
                            Оплата по факту работы
                        </li>
                        <li>
                            Экономия времени и денег
                        </li>
                        <li>
                            Выгодные цены
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>