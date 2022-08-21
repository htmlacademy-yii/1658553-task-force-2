<?php

namespace app\models\forms;

use app\models\Users;
use yii\base\Model;

class ChangePassForm extends Model
{
    public $oldPassword;
    public $newPassword;
    public $newPasswordRepeat;
    public function rules()
    {
        return [
            [['newPassword','newPasswordRepeat'], 'required','message'=>'поле не может быть пустым'],
            [['newPasswordRepeat'], 'compare', 'compareAttribute' => 'newPassword','message'=>'пароли не совпадают'],
            [['newPassword','newPasswordRepeat'],'string','min'=>6,'max'=>20,'tooShort'=>'пароль должен быть от 6 до 20 символов','tooLong'=>'пароль должен быть от 6 до 20 символов'],
            [['oldPassword'],'validatePassword']
        ];
    }

    public function validatePassword($attribute)
    {

        if (!$this->hasErrors()) {
            $user = Users::find()->where(['id'=>\Yii::$app->user->id])->one();

            if (!$user || !\Yii::$app->security->validatePassword($this->oldPassword, $user->password)) {
                $this->addError($attribute, 'Неправильный email или пароль');
            }
        }
    }



}