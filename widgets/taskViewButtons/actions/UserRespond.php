<?php

namespace app\widgets\taskViewButtons\actions;

use app\models\Responses;

/**
 * Проверяем, откликался ли уже пользователь на задание
 */
class UserRespond
{
    public static function isUserRespond($taskId, $userId): bool
    {
        $responsesInfo = Responses::find()->where("task_id = $taskId")->andWhere("executor_id = $userId")->one();
        if ($responsesInfo){
            return false;
        }
        return true;
    }
}