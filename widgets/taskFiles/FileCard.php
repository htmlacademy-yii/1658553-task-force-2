<?php
namespace app\widgets\taskFiles;
use app\services\tasks\GetFilesTaskService;
use yii\base\Widget;


class fileCard extends widget
{
    public $taskId;
    public function run()
    {
        $taskFiles = new GetFilesTaskService($this->taskId);
        return $this->render('fileCard',['taskFiles'=>$taskFiles]);
    }
}