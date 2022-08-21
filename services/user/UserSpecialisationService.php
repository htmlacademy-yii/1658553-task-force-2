<?php

namespace app\services\user;

use app\models\Categories;
use app\models\UserCategories;
use app\models\Users;

class UserSpecialisationService
{
    public static function getUserSpecialisations()
    {
        $userInfo = Users::find()->where(['id'=>\Yii::$app->user->getId()])->one();

        $specialisation = [];

        foreach ($userInfo->userCategories as $userSpecialisation ){
            $categories = Categories::find()->where(['id'=>$userSpecialisation->category_id])->one();
            $specialisation[$userSpecialisation->category_id] = $categories->icon;
        }
        return $specialisation;
    }
}