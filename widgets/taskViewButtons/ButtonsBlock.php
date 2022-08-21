<?php
namespace app\widgets\taskViewButtons;


use app\models\Tasks;
use yii\base\Widget;

class ButtonsBlock extends Widget
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


        return $this->render('buttonsBlock',['taskInfo'=>$task,'responseForm'=>$this->responseForm,
                                             'doneForm'=>$this->doneForm]);
    }
}
