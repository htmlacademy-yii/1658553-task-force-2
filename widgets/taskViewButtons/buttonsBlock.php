<?php
namespace app\widgets\taskViewButtons;


use app\models\Tasks;
use app\widgets\taskViewButtons\actions\accessButtonsControl;
use yii\base\Widget;

class buttonsBlock extends Widget
{
    public $taskId;


    /**
     * @throws \yii\db\Exception
     */
    public function run()
    {
        $task = Tasks::find()->where("id = $this->taskId")->one();
        $taskControl = new accessButtonsControl($task->status,$task->customer_id,$task->executor_id);
        return $this->render('buttonsBlock',['taskControl'=>$taskControl]);
    }
}
