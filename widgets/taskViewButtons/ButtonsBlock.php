<?php
namespace app\widgets\taskViewButtons;


use app\models\Tasks;
use app\widgets\taskViewButtons\actions\accessButtonsControl;
use yii\base\Widget;

class buttonsBlock extends Widget
{
    public int $taskId;
    public object $responseForm;
    public object $doneForm;


    /**
     * @throws \yii\db\Exception
     */
    public function run()
    {

        $task = Tasks::find()->where("id = $this->taskId")->one();

        $taskControl = new accessButtonsControl($task);



        return $this->render('buttonsBlock',['taskControl'=>$taskControl,'responseForm'=>$this->responseForm,'doneForm'=>$this->doneForm]);
    }
}
