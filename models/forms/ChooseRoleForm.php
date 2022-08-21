<?php

namespace app\models\forms;

use yii\base\Model;

class ChooseRoleForm extends Model
{
    public $role;

    public function rules()
    {
        return [
            [['role'], 'required','message'=>'поле не может быть пустым'],
        ];
    }

}