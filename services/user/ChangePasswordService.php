<?php

namespace app\services\user;

use app\models\forms\ChangePassForm;
use app\models\Users;

class ChangePasswordService
{
    public function changePass(ChangePassForm $changePassForm)
    {
        $user = Users::find()->where(['id' => \Yii::$app->user->id])->one();


        $newPasswordHash = \Yii::$app->getSecurity()->generatePasswordHash($changePassForm->newPassword);
        $user->password = $newPasswordHash;
        $user->save();
    }


}