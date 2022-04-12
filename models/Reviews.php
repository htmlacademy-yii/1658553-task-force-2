<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int $executor_id
 * @property int $customer_id
 * @property int $task_id
 * @property int $score
 * @property string $comment
 * @property string $create_time
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['executor_id', 'customer_id', 'task_id', 'score', 'comment', 'create_time'], 'required'],
            [['executor_id', 'customer_id', 'task_id', 'score'], 'integer'],
            [['comment'], 'string'],
            [['create_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'executor_id' => 'Executor ID',
            'customer_id' => 'Customer ID',
            'task_id' => 'Task ID',
            'score' => 'Score',
            'comment' => 'Comment',
            'create_time' => 'Create Time',
        ];
    }
}
