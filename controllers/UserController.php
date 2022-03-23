<?php

namespace app\controllers;

use app\models\Users;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        $contact = new Users();
//        $contact->create_date =date('Y-m-d H:i:s');
//        $contact->email = 'asassa@list.ru';
//        $contact->login = "третий";
//        $contact->password = "ПетровИван";
//        $contact->avatar_file_id = 3;
//        $contact->contact_telegram = 'asd';
//        $contact->contact_phone = '12333';
//        $contact->city_id = 1;
//        $contact->birthday = date('Y-m-d H:i:s');
//        $contact->info = 'asd';
//        $contact->rating = 123;
//        $contact->status = 1;
//        $contact->is_executor = 0;
//
//
//        // сохранение модели в базе данных
//
//        var_dump($contact->save());
//
//        $contact->save();
//        var_dump($contact->getErrors());

        return $this->render('index');
    }

}
