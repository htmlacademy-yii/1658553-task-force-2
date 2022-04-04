<?php

namespace app\controllers;

use app\models\Users;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
