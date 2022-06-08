<?php

namespace app\controllers;

use app\models\Files;
use app\models\forms\AddTaskForm;
use app\models\forms\TaskFilterForm;
use app\models\TaskFiles;
use app\models\Tasks;
use app\services\tasks\AddTaskService;
use app\services\tasks\GetFilesTaskService;
use app\services\tasks\SearchTasksService;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class TasksController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class'        => AccessControl::class,
                'only'         => [],
                'rules'        => [
                    [
                        'allow'   => true,
                        'actions' => ['index', 'view','download'],
                        'roles'   => ['@'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['add'],
                        'roles'   => ['employer'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return Yii::$app->response->redirect(['landing/index']);
                },
            ],
        ];
    }

    //список заданий и фильтры
    public function actionIndex()
    {
        $taskFilterForm = new TaskFilterForm();

        $taskFilterForm->load(Yii::$app->request->post());
        $taskSearchService = new SearchTasksService();
        $tasks = $taskSearchService->search($taskFilterForm);

        return $this->render('index', ['taskInfo' => $tasks, 'taskFilterForm' => $taskFilterForm]
        );
    }

    //просмотр задания

    public function actionView(int $id)
    {
        $taskInfo = Tasks::find()->where("id = $id")->one();
        if (!$taskInfo) {
            throw new NotFoundHttpException('Задание не найдено');
        }



        return $this->render('view', ['taskInfo' => $taskInfo]);
    }


    //создание задания

    public function actionAdd()
    {
        $addTaskForm = new AddTaskForm();
        $addTaskForm->load(Yii::$app->request->post());
        if ($addTaskForm->validate()) {
            $addTaskForm->files = UploadedFile::getInstances($addTaskForm, 'files');
            $addTask = new AddTaskService();
            $newTaskId = $addTask->addTask($addTaskForm);

            return Yii::$app->response->redirect(["tasks/view/$newTaskId"]);
        }

        return $this->render('add', ['addTaskForm' => $addTaskForm]);
    }


    public function actionDownload($fileId)
    {
        $file = Files::find()->where("id = $fileId")->one();
        Yii::$app->response->sendFile($file->path)->send();
    }
}
