<?php

namespace app\services\tasks;


use app\models\forms\TaskFilterForm;
use app\models\Tasks;

class SearchTasksService
{
    public function search(TaskFilterForm $taskFilterForm)
    {
        $query = Tasks::find();

        /** Проверка на чекбокс 'без исполнителя' */
        if ($taskFilterForm->isNoExecutor) {
            $query = $query->where('executor_id IS NULL');
        } else {
            $query = $query->where('executor_id IS NOT NULL');
        }
        /** Проверка на чекбокс 'удаленно' */
        if ($taskFilterForm->isRemote) {
            $query = $query->andWhere('city_id IS NOT NULL');
        } else {
            /**  689 город для проверки, потом в значение будет попадать город пользователя из $_SESSION */
            $query = $query->andWhere(['city_id' => '689']);
        }

        $query = $query->andWhere(['category_id' => $taskFilterForm->categoryIds]);


        return $query->all();
    }
}