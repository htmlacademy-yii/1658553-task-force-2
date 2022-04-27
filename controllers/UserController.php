<?php

namespace app\controllers;

use app\models\Users;
use yii\web\NotFoundHttpException;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionView($id)
    {
        $query = Users::find()->where("id = $id")->one();
        if (!$query){
             return $this->render('view',[throw new NotFoundHttpException('Пользователь не найден')]);
        }

        return $this->render('view',['userInfo'=>$query]);
    }
}
