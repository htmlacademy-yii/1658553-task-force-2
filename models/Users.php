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
 * @property string|null $password
 * @property int|null $avatar_file_id
 * @property string|null $contact_telegram
 * @property string|null $contact_phone
 * @property int $city_id
 * @property string|null $birthday
 * @property string|null $info
 * @property float|null $rating
 * @property int|null $status
 * @property string $auth_via
 * @property string|null $social_id
 *
 * @property Cities $city
 * @property Responses[] $responses
 * @property Tasks[] $tasks
 * @property Tasks[] $tasks0
 * @property UserCategories[] $userCategories
 * @property string $USER                [char(32)]
 * @property int    $CURRENT_CONNECTIONS [bigint]
 * @property int    $TOTAL_CONNECTIONS   [bigint]
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
            [['create_date', 'email', 'login',  'city_id','auth_via'], 'required'],
            [['create_date', 'birthday'], 'safe'],
            [['avatar_file_id', 'city_id', 'status'], 'integer'],
            [['rating'],'number'],
            [['info','social_id'], 'string'],
            [['email', 'login'], 'string', 'max' => 128],
            [['password'], 'string', 'max' => 64],
            [['contact_telegram'], 'string', 'max' => 24],
            [['contact_phone'], 'string', 'max' => 20],
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
    /**
     * Returns user role name according to RBAC
     * @return string
     */
    public function getRoleName()
    {
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        if (!$roles) {
            return null;
        }

        reset($roles);
        /* @var $role \yii\rbac\Role */
        $role = current($roles);

        return $role->name;
    }


    /**
     * Returns user role name according to RBAC
     * @return string
     */
    public function getRoleNameStatic($userId)
    {
        $roles = Yii::$app->authManager->getRolesByUser($userId);
        if (!$roles) {
            return null;
        }

        reset($roles);
        /* @var $role \yii\rbac\Role */
        $role = current($roles);

        return $role->name;
    }
}
