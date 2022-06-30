<?php

namespace app\models;

/**
 * This is the model class for table "tasks".
 *
 * @property int         $id
 * @property string      $create_time
 * @property string      $deadline_time
 * @property string      $name
 * @property string      $info
 * @property int         $category_id
 * @property int         $city_id
 * @property int         $price
 * @property int         $customer_id
 * @property int|null    $executor_id
 * @property int         $status
 *
 * @property Categories  $category
 * @property Cities      $city
 * @property Users       $customer
 * @property Users       $executor
 * @property Responses[] $responses
 * @property TaskFiles[] $taskFiles
 */

class Tasks extends \yii\db\ActiveRecord
{
    public const STATUS_NEW = '1';
    public const STATUS_CANCELLED = '2';
    public const STATUS_IN_WORK = '3';
    public const STATUS_DONE = '4';
    public const STATUS_FAILED = '5';

    public const ACTION_RESPOND = 'respond';
    public const ACTION_CANCEL = 'cancel';
    public const ACTION_DONE = 'done';
    public const ACTION_REFUSE = 'refuse';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    public static function getStatusLabel(int $status)
    {
        $statusMap = [
            1 => 'Новое',
            2 => 'отменено',
            3 => 'В работе',
            4 => 'Выполнено',
            5 => 'Провалено',
        ];
        foreach ($statusMap as $statusId => $statusName) {
            if ($status === $statusId) {
                return $statusName;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['create_time',  'name', 'info', 'category_id', 'city_id', 'customer_id', 'status'],
                'required',
            ],
            [['create_time', 'deadline_time'], 'safe'],
            [['info'], 'string'],
            [['category_id', 'city_id', 'price', 'customer_id', 'executor_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [
                ['category_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Categories::className(),
                'targetAttribute' => ['category_id' => 'id'],
            ],
            [
                ['city_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Cities::className(),
                'targetAttribute' => ['city_id' => 'id'],
            ],
            [
                ['customer_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Users::className(),
                'targetAttribute' => ['customer_id' => 'id'],
            ],
            [
                ['executor_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Users::className(),
                'targetAttribute' => ['executor_id' => 'id'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'create_time'   => 'Create Time',
            'deadline_time' => 'Deadline Time',
            'name'          => 'Name',
            'info'          => 'Info',
            'category_id'   => 'Category ID',
            'city_id'       => 'City ID',
            'price'         => 'Price',
            'customer_id'   => 'Customer ID',
            'executor_id'   => 'Executor ID',
            'status'        => 'Status',

        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Users::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Executor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(Users::className(), ['id' => 'executor_id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Responses::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[TaskFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskFiles()
    {
        return $this->hasMany(TaskFiles::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[file]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'files']);
    }

    public function getId()
    {
        return $this->id;
    }
    /**
     * Возвращает карту статусов
     *
     * @return string[] Карта статусов
     */
    public function getStatusMap(): array
    {
        return [
            self::STATUS_NEW       => 'новое',
            self::STATUS_CANCELLED => 'отмененное',
            self::STATUS_IN_WORK   => 'в работе',
            self::STATUS_DONE      => 'выполнено',
            self::STATUS_FAILED    => 'провалено',
        ];
    }
}
