<?php

namespace app\controllers;

use app\models\forms\TaskFilterForm;
use app\models\Tasks;
use Yii;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        TaskFilterForm::getCategories();
        $taskFilterForm = new TaskFilterForm();
        $taskFilterForm->load(Yii::$app->request->post());

        if (Yii::$app->request->post()){
            if ($taskFilterForm->isNoExecutor) {
                $taskFilterForm->isNoExecutor = 'IS NULL';
            } else {
                $taskFilterForm->isNoExecutor = 'IS NOT NULL';
            }

            if ($taskFilterForm->isRemote) {
                $taskFilterForm->isRemote = 'IS NOT NULL';
            } else {
                $taskFilterForm->isRemote = '= 689';
            }
        }


        $query = Tasks::find()->where("executor_id $taskFilterForm->isNoExecutor")
            ->andWhere([
                'category_id' => $taskFilterForm->categoryIds,
            ])
            ->andWhere("city_id $taskFilterForm->isRemote")
            ->all();

        return $this->render('index', ['taskInfo' => $query, 'taskFilterForm' => $taskFilterForm]);
    }


}
