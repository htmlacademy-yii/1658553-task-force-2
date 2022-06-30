<?php

namespace app\rbacRules;

use app\models\Tasks;
use yii\rbac\Rule;

class RefuseRules extends Rule
{
    public $name = 'isUserExecutor&TaskStatusInWork'; // Имя правила

    public function execute($user, $item, $params)
    {
        $taskId = $params['taskId'];
        $task = Tasks::find()->where("id = $taskId")->one();

        return isset($params['taskId']) && (string)$task->status === Tasks::STATUS_IN_WORK
            && $task->executor_id === (int)$user;
    }
}