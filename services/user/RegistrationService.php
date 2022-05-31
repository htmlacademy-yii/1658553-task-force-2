<?php

namespace app\services\user;

use app\models\forms\RegistrationForm;
use app\models\Users;
use Yii;
use yii\base\Component;
use yii\filters\AccessRule;



class RegistrationService extends Component
{
    public function addUser(RegistrationForm $registrationForm){
        $customer = new Users();
        $customer->login = $registrationForm->login;
        $customer->email = $registrationForm->email;
        $customer->city_id = $registrationForm->city;
        $customer->password = yii::$app->getSecurity()->generatePasswordHash($registrationForm->password);
        $customer->is_executor = $registrationForm->isExecutor;
        $customer->create_date = date('Y-m-d H:i:s');
        $customer->contact_phone = null;
        $customer->birthday = null;
        $customer->info = null;
        $customer->rating = null;
        $customer->status = null;
        //anon.jpg default img
        $customer->avatar_file_id = 1;
        $customer->save();
       if (!$registrationForm->isExecutor){
           $role = Yii::$app->authManager->getRole('employer');
           Yii::$app->authManager->assign($role,$customer->getId());
       }

    }

}