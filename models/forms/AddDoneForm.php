<?php

namespace app\models\forms;

use yii\base\Model;

class AddDoneForm extends Model
{
    public $score;
    public $comment;

    public function rules()
    {
        return [
            [['score', 'comment'], 'required', 'message' => 'поле должно быть заполнено'],
            [
                ['score'],
                'integer',
                'min'      => 1,
                'tooSmall' => 'оценка не может быть 0 или меньше',
                'message'  => 'оценка должен быть целым числом',
            ],
            [['comment'], 'string', 'max' => 50, 'tooLong' => 'Комментарий должно быть меньше'],
        ];
    }
    public function attributeLabels(): array
    {
        return [
            'score'          => 'Оценка',
            'comment'          => 'Ваш комментарий',
        ];
    }

    public function radioScore(){
        return [
            '1'=>1,
            '2'=>2,
            '3'=>3,
            '4'=>4,
            '5'=>5,
        ];
    }

}