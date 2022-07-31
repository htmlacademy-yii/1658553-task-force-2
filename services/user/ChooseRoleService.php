<?php

namespace app\services\user;

use app\models\forms\ChooseRoleForm;
use app\models\Users;
use Yii;

class ChooseRoleService
{
    public function acceptRole(ChooseRoleForm $chooseRoleForm)
    {
        if ($chooseRoleForm->role) {
            $role = Yii::$app->authManager->getRole('employer');

            Yii::$app->authManager->assign($role, \Yii::$app->user->id);
        } else {
            $role = Yii::$app->authManager->getRole('executor');

            Yii::$app->authManager->assign($role, \Yii::$app->user->id);
        }
    }
}