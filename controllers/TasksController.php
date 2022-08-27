<?php

namespace app\controllers;

use app\models\Files;
use app\models\forms\AddDoneForm;
use app\models\forms\AddResponseForm;
use app\models\forms\AddTaskForm;
use app\models\forms\TaskFilterForm;
use app\models\Tasks;
use app\models\Users;
use app\services\tasks\AddTaskService;
use app\services\tasks\ChangeStatusTaskService;
use app\services\tasks\MyTasksService;
use app\services\tasks\ResponseTaskService;
use app\services\tasks\SearchTasksService;
use app\services\user\ReviewsUserService;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
                        'roles'   => ['employer', 'admin'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['my-tasks'],
                        'roles'   => ['employer', 'admin', 'executor'],
                    ],

                ],
                'denyCallback' => function () {
                    return Yii::$app->response->redirect(['landing/index']);
                },
            ],
        ];
    }

    //список заданий и фильтры
    public function actionIndex()
    {
        $taskFilterForm = new TaskFilterForm();
        $clearGetParams = Yii::$app->request->get();
        array_shift($clearGetParams);

        $taskSearchService = new SearchTasksService();

        if ($clearGetParams) {
            $taskFilterForm->load(Yii::$app->request->get());

            $query = $taskSearchService->search($taskFilterForm);
        } else {
            $query = $taskSearchService->defaultSearch();
        }
        $countQuery = clone $query;
        $pages = new Pagination(
            [
                'totalCount'     => $countQuery->count(),
                'pageSize'       => 5,
                'forcePageParam' => false,
                'pageSizeParam'  => false,


            ]
        );
        $tasks = $countQuery->offset($pages->offset)->limit($pages->limit)->all();


        return $this->render('index', ['taskInfo' => $tasks, 'taskFilterForm' => $taskFilterForm, 'pages' => $pages]
        );
    }

    //просмотр задания

    public function actionView(int $id)
    {
        $taskInfo = Tasks::find()->where("id = $id")->one();
        if (!$taskInfo) {
            throw new NotFoundHttpException('Задание не найдено');
        }
        $response = new ResponseTaskService();
        $responseForm = new AddResponseForm();
        $doneForm = new AddDoneForm();
        $doneService = new ReviewsUserService();

        if (Yii::$app->request->post()) {
            if (Yii::$app->request->post('AddResponseForm')) {
                //логика добавления отклика на задание

                $responseForm->load(Yii::$app->request->post());
                if ($responseForm->validate()) {
                    $response->addResponse($responseForm, $id);

                    return Yii::$app->response->redirect(["tasks/view/$id"]);
                }
            } elseif (Yii::$app->request->post('AddDoneForm')) {
                //логика добавления отзыва на задание
                $doneForm->load(Yii::$app->request->post());
                if ($doneForm->validate()) {
                    $doneService->addReviews($doneForm, $id);

                    return Yii::$app->response->redirect(["tasks/done/$id"]);
                }
            }
        }


        //логика списка откликов на задание
        if ((string)$taskInfo->status !== Tasks::STATUS_NEW
            && (string)$taskInfo->status !==
            Tasks::STATUS_CANCELLED
        ) {
            $responses = $response->getResponse($id);
        } else {
            $responses = $response->getResponses($id);
        }


        return $this->render(
            'view',
            [
                'taskInfo'     => $taskInfo,
                'responseForm' => $responseForm,
                'responses'    => $responses,
                'doneForm'     => $doneForm,
            ]
        );
    }


    //создание задания

    public function actionAdd()
    {
        //по умолчанию уведомления о не найденном городе отсутствует
        $notFoundCityMessage = false;

        $addTaskForm = new AddTaskForm();
        if (Yii::$app->request->post()) {
            $addTaskForm->load(Yii::$app->request->post());
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($addTaskForm);
            }
            if ($addTaskForm->validate()) {
                $addTask = new AddTaskService();
                $result = $addTask->addTask($addTaskForm);

                if ($result) {
                    $newTaskId = $result;

                    return Yii::$app->response->redirect(["tasks/view/$newTaskId"]);
                }
                $notFoundCityMessage = 'Этого города нет в списке';
            }
        }


        $userInfo = Users::find()->where(['id' => Yii::$app->user->id])->one();
        $coordinates = [];
        $coordinates['lat'] = unpack('x/x/x/x/corder/Ltype/dlat/dlon', $userInfo->city->coordinates)['lat'];
        $coordinates['lon'] = unpack(
            'x/x/x/x/corder/Ltype/dlat/dlon',
            $userInfo->city->coordinates
        )['lon'];


        return $this->render(
            'add',
            [
                'addTaskForm'         => $addTaskForm,
                'coordinates'         => $coordinates,
                'notFoundCityMessage' => $notFoundCityMessage,
            ]
        );
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
        $doneTask->updateRating();

        return Yii::$app->response->redirect(["tasks/view/$taskId"]);
    }

    public function actionRefuse($taskId)
    {
        $refuseTask = new ChangeStatusTaskService($taskId);
        $refuseTask->refuse();
        $refuseTask->updateRating();

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

    public function actionMyTasks(string $status)
    {
        $user = Users::find()->where(['id' => Yii::$app->user->id])->one();
        $myTasksService = new MyTasksService($user);
        if ($status === 'new' && $user->getRoleName() === 'employer') {
            $query = $myTasksService->getMyTasksNew();
            $countQuery = clone $query;
            $pages = new Pagination(
                [
                    'totalCount'     => $countQuery->count(),
                    'pageSize'       => 5,
                    'forcePageParam' => false,
                    'pageSizeParam'  => false,

                ]
            );
            $tasks = $countQuery->offset($pages->offset)->limit($pages->limit)->all();

            return $this->render('myTasks', ['taskInfo' => $tasks, 'pages' => $pages]
            );
        }

        if ($status === 'progress') {
            $query = $myTasksService->getMyTasksInProgress();
            $countQuery = clone $query;
            $pages = new Pagination(
                [
                    'totalCount'     => $countQuery->count(),
                    'pageSize'       => 5,
                    'forcePageParam' => false,
                    'pageSizeParam'  => false,

                ]
            );
            $tasks = $countQuery->offset($pages->offset)->limit($pages->limit)->all();

            return $this->render('myTasks', ['taskInfo' => $tasks, 'pages' => $pages]
            );
        }

        if ($status === 'delayed' && $user->getRoleName() === 'executor') {
            $query = $myTasksService->getMyTasksDelayed();
            $countQuery = clone $query;
            $pages = new Pagination(
                [
                    'totalCount'     => $countQuery->count(),
                    'pageSize'       => 5,
                    'forcePageParam' => false,
                    'pageSizeParam'  => false,

                ]
            );
            $tasks = $countQuery->offset($pages->offset)->limit($pages->limit)->all();

            return $this->render('myTasks', ['taskInfo' => $tasks, 'pages' => $pages]
            );
        }

        if ($status === 'closed') {
            $query = $myTasksService->getMyTasksClosed();
            $countQuery = clone $query;
            $pages = new Pagination(
                [
                    'totalCount'     => $countQuery->count(),
                    'pageSize'       => 5,
                    'forcePageParam' => false,
                    'pageSizeParam'  => false,

                ]
            );
            $tasks = $countQuery->offset($pages->offset)->limit($pages->limit)->all();

            return $this->render('myTasks', ['taskInfo' => $tasks, 'pages' => $pages]
            );
        }

        return Yii::$app->response->redirect(["tasks/index"]);
    }
}
