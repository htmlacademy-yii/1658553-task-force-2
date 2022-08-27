<?php

namespace app\services\user;

use app\models\Files;
use app\models\forms\UserSettingsForm;
use app\models\UserCategories;
use app\models\Users;
use yii\helpers\Url;
use yii\web\UploadedFile;

class UserSettingsService
{
    public function submitChanges(UserSettingsForm $userSettingsForm)
    {
        $user = Users::find()->where(['id' => \Yii::$app->user->getId()])->one();
        $user->email = $userSettingsForm->email;
        $user->login = $userSettingsForm->login;
        $user->contact_telegram = $userSettingsForm->contact_telegram;
        $user->contact_phone = $userSettingsForm->contact_phone;
        $user->birthday = $userSettingsForm->birthday;
        $user->info = $userSettingsForm->info;
        $userSettingsForm->file = UploadedFile::getInstances($userSettingsForm, 'file');
        if ($userSettingsForm->file) {

            $path = "img/avatars/"."$user->id/";
            if (!file_exists(Url::to("@app/web/".$path))) {
                mkdir(Url::to('@app/web/'.$path), 0777, true);
            }
            foreach ($userSettingsForm->file as $file) {
                $fileName = $file->baseName.'.'.$file->extension;

                $file->saveAs(
                    $path.$fileName
                );
                $newFile = Files::find()->where(['id'=>$user->avatar_file_id])->one();

                if (file_exists(substr($newFile->path,1))){
                    unlink(substr($newFile->path,1));
                }
                $newFile->path = "/$path"."$fileName";
                $newFile->save();
                $user->avatar_file_id = $newFile->id;
            }
        }
        $oldUserCategories = UserCategories::find()->where(['user_id'=>$user->id])->all();
        foreach ($oldUserCategories as $category){
            $category->delete();
        }
        if ($userSettingsForm->specialisation){
            foreach ($userSettingsForm->specialisation as $categoriesId){
                $newUserCategories = new UserCategories();
                $newUserCategories->user_id = $user->id;
                $newUserCategories->category_id = $categoriesId;
                $newUserCategories->save();
            }
        }



        $user->save();
    }


}