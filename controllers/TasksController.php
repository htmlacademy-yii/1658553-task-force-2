<?php

namespace app\controllers;

use app\models\Tasks;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Tasks::find()->where(['executor_id'=>null])->limit(3)->all();
        return $this->render('index', ['taskInfo' => $query]);
    }


}
