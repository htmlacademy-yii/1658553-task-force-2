<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $create_date
 * @property string $email
 * @property string $login
 * @property string $password
 * @property int|null $avatar_file_id
 * @property string|null $contact_telegram
 * @property string|null $contact_phone
 * @property int $city_id
 * @property string|null $birthday
 * @property string|null $info
 * @property int|null $rating
 * @property int|null $status
 * @property int $is_executor
 *
 * @property Cities $city
 * @property Responses[] $responses
 * @property Tasks[] $tasks
 * @property Tasks[] $tasks0
 * @property UserCategories[] $userCategories
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_date', 'email', 'login', 'password', 'city_id', 'is_executor'], 'required'],
            [['create_date', 'birthday'], 'safe'],
            [['avatar_file_id', 'city_id', 'rating', 'status', 'is_executor'], 'integer'],
            [['info'], 'string'],
            [['email', 'login'], 'string', 'max' => 128],
            [['password'], 'string', 'max' => 64],
            [['contact_telegram'], 'string', 'max' => 24],
            [['contact_phone'], 'string', 'max' => 11],
            [['email'], 'unique'],
            [['email'],'email'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_date' => 'Create Date',
            'email' => 'Email',
            'login' => 'Login',
            'password' => 'Password',
            'avatar_file_id' => 'Avatar File ID',
            'contact_telegram' => 'Contact Telegram',
            'contact_phone' => 'Contact Phone',
            'city_id' => 'City ID',
            'birthday' => 'Birthday',
            'info' => 'Info',
            'rating' => 'Rating',
            'status' => 'Status',
            'is_executor' => 'Is Executor',
        ];
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
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Responses::className(), ['executor_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Tasks::className(), ['executor_id' => 'id']);
    }

    /**
     * Gets query for [[UserCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCategories()
    {
        return $this->hasMany(UserCategories::className(), ['user_id' => 'id']);
    }
    /**
     * Gets query for [[file]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'avatar_file_id']);
    }
    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['executor_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return true;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return true;
    }

    public function validateAuthKey($authKey)
    {
        return true;
    }
}
