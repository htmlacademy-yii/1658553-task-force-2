<?php

namespace app\services\tasks;

use app\models\Reviews;
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
        }
    }

    public function refuse()
    {
        if ((new ActionRefuse())->isAvailable($this->control, $this->user->id)) {
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

    public function updateRating()
    {
        $taskId = $this->task->id;
        $failStatus = accessButtonsControl::STATUS_FAILED;

        $task = Tasks::find()->where("id = $taskId")->one();

        $failTasks = Tasks::find()->where("executor_id = $task->executor_id")->andWhere(
            "status = $failStatus"
        )->all();


        $reviews = Reviews::find()->where("executor_id = $task->executor_id")->all();
        $reviewCountResponses = 0;
        $reviewCountScore = 0;
        $failTasksCount = count($failTasks);
        foreach ($reviews as $review) {
            $reviewCountScore = $reviewCountScore + (int)$review->score;
            $reviewCountResponses++;
        }
        $executor = Users::find()->where("id = $task->executor_id")->one();
        $executor->rating = round(((int)$reviewCountScore / (int)$reviewCountResponses + (int)$failTasksCount), 2);
        $executor->save();
    }
}