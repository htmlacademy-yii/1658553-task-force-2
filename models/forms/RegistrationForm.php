<?php

namespace app\models\forms;


use app\models\Cities;
use app\models\Users;
use yii\base\Model;


class RegistrationForm extends Model
{
    public $login;
    public $email;
    public $city;
    public $password;
    public $password_repeat;
    public $isExecutor;

    /**
     * @return array[] Поля формы
     */
    public function rules(): array
    {
        return [
            [['login', 'email', 'city', 'password','password_repeat','isExecutor'], 'required','message'=>'заполните обязательные поля'],
            [['login','email'],'string','max'=>128,'message'=>'максимум 128 символов'],
            [['email'],'email','message'=>'почта не валидна'],
            [['email'],'unique','targetClass' => Users::class, 'targetAttribute' => ['email' => 'email'],
                                'message'=>'Такая почта уже зарегистрирована'],
            [['email','login'],'trim'],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['city'
                                                                                                             => 'id']],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password','message'=>'пароли не совпадают'],
            [['password','password_repeat'],'string','min'=>6,'max'=>20,'tooShort'=>'пароль должен быть от 6 до 20 символов','tooLong'=>'пароль должен быть от 6 до 20 символов']
        ];
    }

    /**
     * @return string[] Названия полей формы
     */
    public function attributeLabels(): array
    {
        return [
            'login'  => 'Ваше имя',
            'email' => 'Email',
            'city'     => 'Город',
            'password'     => 'Пароль',
            'password_repeat'     => 'Повтор пароля',
            'isExecutor'     => 'Я собираюсь откликаться на заказы',

        ];
    }
    public static function getCities(){
        /**
         * @var Cities[] $cities
         */
        $cities = Cities::find()->all();
        $citiesData = [];
        foreach ($cities as $city) {
            $citiesData[$city->id] = $city->name;
        }

        return $citiesData;
    }


}