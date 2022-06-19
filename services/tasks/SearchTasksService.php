<?php

namespace app\services\tasks;


use app\models\Categories;
use app\models\forms\TaskFilterForm;
use app\models\Tasks;
use app\models\Users;
use Codeception\Module\Yii2;

class SearchTasksService
{
    public function search(TaskFilterForm $taskFilterForm)
    {
        $userId = \Yii::$app->user->id;
        $user = Users::find()->where("id = $userId")->one();


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

            $query = $query->andWhere(['city_id' => "$user->city_id"]);
        }





        $categoryList = [
            $taskFilterForm->translation, $taskFilterForm->clean, $taskFilterForm->cargo,
            $taskFilterForm->neo, $taskFilterForm->flat, $taskFilterForm->repair, $taskFilterForm->beauty, $taskFilterForm->photo
        ];


        $taskFilterForm->categoryIds = [];

        foreach ($categoryList as $categoryItem){
            if ($categoryItem){
                $taskFilterForm->categoryIds[] = (int) $categoryItem;
            }

        }







        return $query->andWhere(['category_id' => $taskFilterForm->categoryIds]);
    }
}