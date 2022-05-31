<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SiteController extends Controller
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
                        'actions' => ['index', 'view'],
                        'roles'   => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return Yii::$app->response->redirect(['landing/index']);
                },
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
