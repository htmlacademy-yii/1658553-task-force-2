<?php

namespace app\controllers;

use app\models\forms\TaskFilterForm;
use app\models\Tasks;
use Yii;
use yii\web\NotFoundHttpException;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        TaskFilterForm::getCategories();
        $taskFilterForm = new TaskFilterForm();
        $taskFilterForm->load(Yii::$app->request->post());

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


        $query = $query->all();

        return $this->render('index', ['taskInfo' => $query, 'taskFilterForm' => $taskFilterForm, 'controller' => $this]
        );
    }


    public function actionView(int $id)
    {
        $query = Tasks::find()->where("id = $id")->one();
        if (!$query) {
            return $this->render('view', [throw new NotFoundHttpException('Задание не найдено')]);
        }

        return $this->render('view', ['taskInfo' => $query]);
    }

}
