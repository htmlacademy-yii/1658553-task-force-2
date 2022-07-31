<?php
/* @var $this yii\web\View */

/* @var object $taskInfo */

/* @var object $taskFiles */
/* @var object $responses */

/* @var object $responseForm */
/* @var object $doneForm */

use app\widgets\responseCard\responseBlock;
use app\widgets\taskFiles\fileCard;
use app\widgets\taskViewButtons\buttonsBlock;
use yii\helpers\Html;
use app\models\Tasks;





?>

<script type="text/javascript"
        src="https://api-maps.yandex.ru/2.1/?apikey=e666f398-c983-4bde-8f14-e3fec900592a&lang=ru_RU">

</script>
<?php if ($taskInfo->tasks_coordinate): ?>
<script type="text/javascript">
    ymaps.ready(init);

    function init () {
        const map = new ymaps.Map('map', {
                center: [<?=unpack('x/x/x/x/corder/Ltype/dlat/dlon', $taskInfo->tasks_coordinate)['lat']?>, <?=unpack
                ('x/x/x/x/corder/Ltype/dlat/dlon', $taskInfo->tasks_coordinate)['lon']?>],
                zoom: 15
            })

        const placemark = new ymaps.Placemark([<?=unpack('x/x/x/x/corder/Ltype/dlat/dlon', $taskInfo->tasks_coordinate)
        ['lat']?>, <?=unpack
        ('x/x/x/x/corder/Ltype/dlat/dlon', $taskInfo->tasks_coordinate)['lon']?>]);



        map.geoObjects.add(placemark);
    }
</script>
<?php endif;?>
<main class="main-content container">

    <div class="left-column">
        <div class="head-wrapper">
            <h3 class="head-main"><?= $taskInfo->name ?></h3>
            <p class="price price--big"><?= $taskInfo->price ?> ₽</p>
        </div>
        <p class="task-description">
            <?= $taskInfo->info ?></p>
        <?= ButtonsBlock::widget(['taskId' => $taskInfo->id, 'responseForm' => $responseForm,'doneForm'=>$doneForm]) ?>


            <div id="map" style="width: 600px; height: 400px"></div



        <?=ResponseBlock::widget(['responses'=>$responses,'taskInfo' => $taskInfo])?>
    </div>
    <div class="right-column">
        <div class="right-card black info-card">
            <h4 class="head-card">Информация о задании</h4>
            <dl class="black-list">
                <dt>Категория</dt>
                <dd><?= $taskInfo->category->name ?></dd>
                <dt>Дата публикации</dt>

                <dd><?= Yii::$app->formatter->asDate($taskInfo->create_time) ?></dd>
                <dt>Срок выполнения</dt>
                <dd><?= Yii::$app->formatter->asDate($taskInfo->deadline_time) ?></dd>
                <dt>Статус</dt>
                <dd><?= Tasks::getStatusLabel($taskInfo->status) ?></dd>
            </dl>
        </div>
        <?= FileCard::widget(['taskId' => $taskInfo->id]) ?>
    </div>

</main>

