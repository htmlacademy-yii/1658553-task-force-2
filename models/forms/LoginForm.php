<?php

namespace app\models\forms;

use app\models\Users;
use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;

class LoginForm extends Model
{
    public $email;
    public $password;

    private $user;


    public function rules()
    {
        return [
            [['email', 'password'], 'required','message'=>'поле не может быть пустым'],
            [['password'], 'validatePassword'],


        ];
    }



    public function getUser()
    {
        if ($this->user === null) {
            $this->user = Users::find()->where(['email'=>$this->email])->one();
        }

        return $this->user;
    }

    public function validatePassword($attribute)
    {

        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !\Yii::$app->security->validatePassword($this->password, $user->password)) {
                $this->addError($attribute, 'Неправильный email или пароль');
            }
        }
    }



}