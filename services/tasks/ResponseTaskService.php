<?php

namespace app\services\tasks;

use app\models\forms\AddResponseForm;
use app\models\Responses;
use app\models\Tasks;
use Yii;

class ResponseTaskService
{
    public function addResponse(AddResponseForm $responseForm, $taskId)
    {
        $response = new Responses();
        $response->task_id = $taskId;
        $response->executor_id = Yii::$app->user->id;
        $response->price = $responseForm->price;
        $response->comment = $responseForm->comment;
        $response->rejected = false;
        $response->create_time = date('Y-m-d H:i:s');
        $response->save();
    }

    public function getResponses(int $taskId)
    {
        $responses = Responses::find()->where("task_id = $taskId")->andWhere(["rejected" => false])->all();

        return $responses;
    }

    public function getResponse(int $taskId)
    {
        $taskInfo = Tasks::find()->where("id = $taskId")->one();

        return Responses::find()->where("task_id = $taskId")->andWhere("executor_id = $taskInfo->executor_id")->all();
    }

    public function toDoRejected(int $taskId, int $executorId)
    {
        $responses = Responses::find()->where("task_id = $taskId")->andWhere(["executor_id" => $executorId])->one();
        $responses->rejected = true;
        $responses->save();
    }

}