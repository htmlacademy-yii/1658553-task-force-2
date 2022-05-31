<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class ExitController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => ['index','view'],
                        'roles' => ['?']
                    ]
                ]
            ]
        ];
    }

    public function actionLogout() {

        \Yii::$app->user->logout();

        return $this->redirect(['landing/index']);
    }
}