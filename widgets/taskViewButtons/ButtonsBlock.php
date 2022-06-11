<?php
namespace app\widgets\taskViewButtons;


use app\models\Tasks;
use app\widgets\taskViewButtons\actions\accessButtonsControl;
use yii\base\Widget;

class buttonsBlock extends Widget
{
    public $taskId;
    public object $responseForm;


    /**
     * @throws \yii\db\Exception
     */
    public function run()
    {
        $responseForm = $this->responseForm;

        $task = Tasks::find()->where("id = $this->taskId")->one();

        $taskControl = new accessButtonsControl($task);



        return $this->render('buttonsBlock',['taskControl'=>$taskControl,'responseForm'=>$responseForm]);
    }
}
