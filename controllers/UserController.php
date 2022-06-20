<?php

namespace app\controllers;

use app\models\Users;
use app\services\user\SuccessFailCountService;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => [],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','view'],
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        $query = Users::find()->where("id = $id")->one();

        if (!$query) {
            throw new NotFoundHttpException('Пользователь не найден');
        }
        $successFailCount = new SuccessFailCountService();
        $successFailCount = $successFailCount->search($id);


        return $this->render('view', ['userInfo' => $query, 'successFailCount' => $successFailCount]);
    }
}
