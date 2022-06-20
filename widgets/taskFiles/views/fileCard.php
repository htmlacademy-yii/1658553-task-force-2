<?php
/** @var object $taskFiles */

use yii\helpers\Html;

?>

<?php
if ($taskFiles->getFilesName()): ?>
    <div class="right-card white file-card">
        <h4 class="head-card">Файлы задания</h4>
        <ul class="enumeration-list">

            <?php
            foreach ($taskFiles->getFilesName() as $fileId => $fileInfo): ?>
                <li class="enumeration-item">
                    <?= Html::a($fileInfo['name'], ["/tasks/download/$fileId"], [
                        'class' => 'link link--block
                    link--clip',
                    ]) ?>
                    <p class="file-size"><?= Yii::$app->formatter->asShortSize($fileInfo['size']) ?></p>
                </li>
            <?php
            endforeach ?>
        </ul>
    </div>
<?php
endif ?>