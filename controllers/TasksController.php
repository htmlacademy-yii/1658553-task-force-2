<?php

namespace app\controllers;

use app\models\Files;
use app\models\forms\AddResponseForm;
use app\models\forms\AddTaskForm;
use app\models\forms\TaskFilterForm;
use app\models\Tasks;
use app\services\tasks\AddTaskService;
use app\services\tasks\ChangeStatusTaskService;
use app\services\tasks\ResponseTaskService;
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
                        'actions' => ['index', 'view', 'download', 'cancel', 'done', 'refuse', 'respond', 'rejected'],
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
        $responseForm = new AddResponseForm();
        $responseForm->load(Yii::$app->request->post());
        $response = new ResponseTaskService();
        $responses = $response->getResponses($id);
        if ($responseForm->validate()) {
            $response->addResponse($responseForm, $id);

            return Yii::$app->response->redirect(["tasks/view/$id"]);
        }


        return $this->render(
            'view',
            ['taskInfo' => $taskInfo, 'responseForm' => $responseForm, 'responses' => $responses]
        );
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


    public function actionDownload(int $fileId)
    {
        $file = Files::find()->where("id = $fileId")->one();
        Yii::$app->response->sendFile($file->path)->send();
    }

    public function actionCancel($taskId)
    {
        $cancelTask = new ChangeStatusTaskService($taskId);
        $cancelTask->cancel();

        return Yii::$app->response->redirect(["tasks/view/$taskId"]);
    }

    public function actionDone($taskId)
    {
        $doneTask = new ChangeStatusTaskService($taskId);
        $doneTask->done();

        return Yii::$app->response->redirect(["tasks/view/$taskId"]);
    }

    public function actionRefuse($taskId)
    {
        $refuseTask = new ChangeStatusTaskService($taskId);
        $refuseTask->refuse();

        return Yii::$app->response->redirect(["tasks/view/$taskId"]);
    }

    public function actionRespond(int $taskId, int $executorId)
    {
        $respondTask = new ChangeStatusTaskService($taskId);
        $respondTask->respond($executorId);

        return Yii::$app->response->redirect(["tasks/view/$taskId"]);
    }

    /**
     * Одобрение/отклонение пользователя в роль исполнителя
     */
    public function actionRejected(int $taskId, int $executorId, bool $isRejected)
    {
        $response = new ResponseTaskService();

        if ($isRejected) {
            $response->toDoRejected($taskId, $executorId);

            return Yii::$app->response->redirect(["tasks/view/$taskId"]);
        }

        return Yii::$app->response->redirect(["tasks/respond/$taskId/$executorId"]);
    }
}
