<?php

namespace app\services\user;

use app\models\forms\AddDoneForm;
use app\models\Reviews;
use app\models\Tasks;

class ReviewsUserService
{
    public function addReviews(AddDoneForm $addDoneForm, int $taskId){
        $taskInfo = Tasks::find()->where("id = $taskId")->one();
        $reviews = new Reviews();
        $reviews->executor_id = $taskInfo->executor_id;
        $reviews->customer_id = $taskInfo->customer_id;
        $reviews->task_id = $taskId;
        $reviews->score = $addDoneForm->score;
        $reviews->comment = $addDoneForm->comment;
        $reviews->create_time = date('Y-m-d H:i:s');
        $reviews->save();
    }
}