<?php

namespace app\models\forms;

use yii\base\Model;

class UserSettingsForm extends Model
{
    public $avatar;
    public $login;
    public $email;
    public $birthday;
    public $contact_phone;
    public $contact_telegram;
    public $info;
    public $specialisation;
    public $file;

    public function rules(): array
    {
        return [
            [['birthday'], 'safe'],
            [['file'], 'file'],
            [['info'], 'string'],
            [['email', 'login'], 'string', 'max' => 128],
            [['contact_telegram'], 'string', 'max' => 24],
            [['contact_phone'], 'string', 'max' => 20],
            [['email'], 'email'],
            [['specialisation'],'each','rule' => ['string']]
        ];
    }

    public function attributeLabels()
    {
        return [
            'login'            => 'Ваше имя',
            'email'            => 'Email',
            'birthday'         => 'День Рождения',
            'contact_phone'    => 'Номер Телефона',
            'contact_telegram' => 'Telegram',
            'info'             => 'Информация о себе',
            'specialisation' => 'Категории'

        ];
    }
}