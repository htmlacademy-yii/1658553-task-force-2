<?php

namespace app\widgets\navigationBar;

use app\models\Users;
use Yii;
use yii\base\Widget;

class UserBlock extends Widget
{
    public function run()
    {
        $id = Yii::$app->user->identity->getId();
        $user = Users::find()->where("id = $id")->one();

        return $this->render('userBlock',['user'=>$user]);
    }
}