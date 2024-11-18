<?php

namespace common\models;

use vova07\fileapi\behaviors\UploadBehavior;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $full_name ФИО
 * @property string $description Описание
 * @property int $status Статус
 * @property int $department_id Отдел id
 * @property int $level_id Уровень id
 * @property string $image Фото
 * @property string $created_at Время создания
 * @property string $updated_at Время обновления
 * @property string $username
 * @property string $email
 * @property string $phone
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $password
 * @property integer $access_status
 */
class Employees extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_NOT_PUBLISHED = 0;
    const STATUS_PUBLISHED = 10;

    const STATUS_IN_ACTIVE = 0;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'image' => [
                        'path' => '@static/web/employees/',
                        'tempPath' => '@static/temp/',
                        'url' => $this->getPath()
                    ]
                ]
            ],
            [
                'class' => TimestampBehavior::className(),
                'value' => function () {
                    return Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                },
            ],
        ];

    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'username', 'email', 'phone', 'auth_key', 'password_hash', 'password_reset_token', 'password'], 'string'],
            [['status', 'department_id', 'level_id', 'access_status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['full_name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'full_name' => Yii::t('backend', 'Full Name'),
            'description' => Yii::t('backend', 'Description'),
            'status' => Yii::t('backend', 'Status'),
            'department_id' => Yii::t('backend', 'Department ID'),
            'level_id' => Yii::t('backend', 'Level ID'),
            'image' => Yii::t('backend', 'Image'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'username' => Yii::t('backend', 'Username'),
            'email' => Yii::t('backend', 'Email'),
            'phone' => Yii::t('backend', 'Phone'),
            'password' => Yii::t('backend', 'Password'),
        ];
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getAccessStatusLabel()
    {
        return ArrayHelper::getValue(static::getAccessStatuses(), $this->access_status);
    }

    /**
     * @return array
     */
    public static function getAccessStatuses()
    {
        return [
            self::STATUS_ACTIVE     => Yii::t('backend', 'Active'),
            self::STATUS_IN_ACTIVE => Yii::t('backend', 'In active'),
        ];
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getStatusLabel()
    {
        return ArrayHelper::getValue(static::getStatuses(), $this->status);
    }

    /**
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_PUBLISHED     => Yii::t('backend', 'Published'),
            self::STATUS_NOT_PUBLISHED => Yii::t('backend', 'Not Published'),
        ];
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return Yii::$app->params['staticDomain'] . '/employees/';
    }

    /**
     * @return string
     */
    public function getImgUrl()
    {
        return $this->image ? $this->getPath() . $this->image : $this->getPath() . '/default.png';
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'access_status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'access_status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
}
