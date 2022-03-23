<?php

namespace app\controllers;

use app\models\Files;

class FilesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $contact = new Files();
        $contact->path = 'andry@list.ru';
        $contact->save();

        return $this->render('index');
    }

}
