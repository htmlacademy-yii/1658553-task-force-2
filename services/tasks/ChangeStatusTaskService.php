<?php

namespace app\services\tasks;

use app\models\Reviews;
use app\models\Tasks;
use app\models\Users;
use Yii;

class ChangeStatusTaskService
{
    public object $task;


    public function __construct($taskId)
    {
        $this->task = Tasks::find()->where("id = $taskId")->one();
    }

    public function cancel()
    {
        if (Yii::$app->user->can('cancelTask', ['taskId' => $this->task->id])) {
            $this->task->status = Tasks::STATUS_CANCELLED;
            $this->task->save();
        }
    }

    public function respond($executorId)
    {
        if (Yii::$app->user->can('cancelTask', ['taskId' => $this->task->id])) {
            $this->task->status = Tasks::STATUS_IN_WORK;
            $this->task->executor_id = $executorId;
            $this->task->save();
        }
    }

    public function refuse()
    {
        if (Yii::$app->user->can('refuseTask', ['taskId' => $this->task->id])) {
            $this->task->status = Tasks::STATUS_FAILED;
            $this->task->save();
        }
    }

    public function done()
    {
        if (Yii::$app->user->can('doneTask', ['taskId' => $this->task->id])) {
            $this->task->status = Tasks::STATUS_DONE;
            $this->task->save();
        }
    }

    public function updateRating()
    {
        $taskId = $this->task->id;
        $failStatus = Tasks::STATUS_FAILED;

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
        if ($executor->rating) {
            $executor->rating = round(((int)$reviewCountScore / (int)$reviewCountResponses + (int)$failTasksCount), 2);
            $executor->save();
        } else {
            $executor->rating = 1;
            $executor->save();
        }
    }
}