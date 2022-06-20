<?php

namespace app\widgets\responseCard;

use yii\base\Widget;

class responseBlock extends Widget
{
    public array $responses;
    public object $taskInfo;

    public function isTaskHaveExecutor(){

    }
    public function run()
    {


        return $this->render('responseList', ['responses' => $this->responses, 'taskInfo' => $this->taskInfo]);
    }
}