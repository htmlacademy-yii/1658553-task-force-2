<?php

namespace app\services\user;

use app\models\Tasks;

/**
 * Реализация счетчика успешных/проваленных заданий юзера
 */
class SuccessFailCountService
{
    public function search(int $executor)
    {
        $result = [];
        $success = Tasks::find()->where("executor_id = $executor")->andWhere('status = 5')
            ->all();
        $fail = Tasks::find()->where("executor_id = $executor")->andWhere('status = 3')->all();
        $countSuccess = count($success);
        $result['success'] = $countSuccess;
        $countFail = count ($fail);
        $result['fail'] = $countFail;

        return $result;
    }
}