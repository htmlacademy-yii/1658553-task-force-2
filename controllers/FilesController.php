<?php

namespace app\controllers;

use app\models\Files;

class FilesController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        $files = new Files();
//        $files->path = 'somePathToTest';
//        $files->save();

        return $this->render('index');
    }

}
