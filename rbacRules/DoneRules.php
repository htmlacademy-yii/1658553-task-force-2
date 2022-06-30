<?php

namespace app\rbacRules;

use app\models\Tasks;
use yii\rbac\Item;
use yii\rbac\Rule;

class DoneRules extends Rule
{
    public $name = 'isUserEmployer&TaskStatusInWork'; // Имя правила

    public function execute($user, $item, $params)
    {
        $taskId = $params['taskId'];
        $task = Tasks::find()->where("id = $taskId")->one();

        return isset($params['taskId']) && (string)$task->status === Tasks::STATUS_IN_WORK &&
            $task->customer_id === (int)$user;
    }
}