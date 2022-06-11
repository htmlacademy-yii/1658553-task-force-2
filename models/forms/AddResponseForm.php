<?php

namespace app\models\forms;

use yii\base\Model;

class AddResponseForm extends Model
{
    public $price;
    public $comment;

    public function rules()
    {
        return [
            [['price', 'comment'], 'required', 'message' => 'поле должно быть заполнено'],
            [
                ['price'],
                'integer',
                'min'      => 1,
                'tooSmall' => 'Бюджет не может быть 0 или меньше',
                'message'  => 'Бюджет должен быть целым числом',
            ],
            [['comment'], 'string', 'max' => 50, 'tooLong' => 'описание должно быть меньше'],
        ];
    }
    public function attributeLabels(): array
    {
        return [
            'price'          => 'Запрашиваемый бюджет',
            'comment'          => 'Ваш комментарий',

        ];
    }
}

