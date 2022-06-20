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
        $success = Tasks::find()->where("executor_id = $executor")->andWhere('status = 4')
            ->all();
        $fail = Tasks::find()->where("executor_id = $executor")->andWhere('status = 5')->all();
        $busy = Tasks::find()->where("executor_id = $executor")->andWhere('status = 3')->all();
        if ($busy) {
            $status = 'Занят';
        } else {
            $status = 'Открыт для новых заказов';
        }
        $countSuccess = count($success);
        $result['success'] = $countSuccess;
        $countFail = count($fail);
        $result['fail'] = $countFail;

        $result['status'] = $status;

        return $result;
    }
}