<?php

namespace app\rbacRules;

use app\models\Tasks;
use yii\rbac\Rule;

class RespondRules extends Rule
{
    public $name = 'isUserExecutor&TaskStatusCreate'; // Имя правила


    public function execute($user, $item, $params)
    {
        $taskId = $params['taskId'];
        $task = Tasks::find()->where("id = $taskId")->one();


        return isset($params['taskId']) && (string)$task->status === Tasks::STATUS_NEW
            && $task->executor_id
            === null && $task->customer_id !== (int)$user;
    }

}