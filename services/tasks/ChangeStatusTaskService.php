<?php

namespace app\services\tasks;

use app\models\Tasks;
use app\models\Users;
use app\widgets\taskViewButtons\actions\accessButtonsControl;
use app\widgets\taskViewButtons\actions\ActionCancel;
use app\widgets\taskViewButtons\actions\ActionDone;
use app\widgets\taskViewButtons\actions\ActionRefuse;
use app\widgets\taskViewButtons\actions\ActionRespond;
use Yii;

class ChangeStatusTaskService
{
    public object $task;
    public object $user;
    private object $control;

    public function __construct($taskId)
    {
        $userId = Yii::$app->user->id;
        $this->user = Users::find()->where("id = $userId")->one();
        $this->task = Tasks::find()->where("id = $taskId")->one();
        $this->control = new AccessButtonsControl($this->task);
    }

    public function cancel()
    {
        if ((new ActionCancel())->isAvailable($this->control, $this->user->id)) {
            $this->task->status = accessButtonsControl::STATUS_CANCELLED;
            $this->task->save();
        }
    }

    public function respond($executorId)
    {
        if ((new ActionRespond())->isAvailable($this->control, $this->user->id)) {

            $this->task->status = accessButtonsControl::STATUS_IN_WORK;
            $this->task->executor_id = $executorId;
            $this->task->save();
        } else{
            print 'za';
            die();
        }
    }

    public function refuse()
    {
        if ((new ActionRefuse())->isAvailable($this->control,$this->user->id)) {
            $this->task->status = accessButtonsControl::STATUS_FAILED;
            $this->task->save();
        }
    }
    public function done()
    {
        if ((new ActionDone())->isAvailable($this->control, $this->user->id)) {
            $this->task->status = accessButtonsControl::STATUS_DONE;
            $this->task->save();
        }
    }
}