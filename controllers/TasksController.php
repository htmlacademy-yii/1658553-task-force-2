<?php

namespace app\controllers;
use app\models\Tasks;
use yii\db\Query;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        $contact = new Tasks();
//        $contact->create_time =date ('Y-m-d H:i:s');
//        $contact->deadline_time = date('Y-m-d H:i:s');
//        $contact->name = 'task3';
//        $contact->info = 'task3';
//        $contact->category_id = 1;
//        $contact->city_id = 456;
//        $contact->price = 1;
//        $contact->customer_id = 1;
//        $contact->executor_id = null;
//        $contact->status = 0;
//        $contact->save();

        $query = new Query();
        $query->select(['t.create_time','t.name','t.info','cities.name AS city','t.price'])->from('tasks t')
            ->join('LEFT JOIN', 'cities','t.city_id = cities.id')
            ->where(['executor_id'=>null])->limit(3);
        $taskInfo = $query->all();



        return $this->render('index',['taskInfo'=>$taskInfo]);
    }


}
