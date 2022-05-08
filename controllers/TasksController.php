<?php

namespace app\controllers;

use app\models\forms\TaskFilterForm;
use app\models\Tasks;
use app\services\tasks\SearchTasksService;
use Yii;
use yii\web\NotFoundHttpException;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        TaskFilterForm::getCategories();
        $taskFilterForm = new TaskFilterForm();
        $taskFilterForm->load(Yii::$app->request->post());

        $taskSearchService = new SearchTasksService();
        $tasks = $taskSearchService->search($taskFilterForm);

        return $this->render('index', ['taskInfo' => $tasks, 'taskFilterForm' => $taskFilterForm, 'controller' => $this]
        );
    }



    public function actionView(int $id)
    {
        $query = Tasks::find()->where("id = $id")->one();
        if (!$query) {
            throw new NotFoundHttpException('Задание не найдено');
        }

        return $this->render('view', ['taskInfo' => $query]);
    }

}
