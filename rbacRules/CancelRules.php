<?php

namespace app\rbacRules;

use app\models\Tasks;
use yii\rbac\Rule;

class CancelRules extends Rule
{

    public $name = 'isUserEmployer&TaskStatusCreate'; // Имя правила


    public function execute($user, $item, $params)
    {
        $taskId = $params['taskId'];
        $task = Tasks::find()->where("id = $taskId")->one();


        return isset($params['taskId']) && $task->customer_id === (int)$user
            && (string)$task->status ===
            Tasks::STATUS_NEW;
    }
}