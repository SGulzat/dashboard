<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name Название
 * @property string $description Описание
 * @property string $date_start Время начало
 * @property string $date_end Время окончание
 * @property int $status Статус
 * @property int $department_id Отдел id
 * @property int $level_id Уровень id
 * @property string $created_at Время создания
 * @property string $updated_at Время обновления
 * @property int $execute_status
 */
class Tasks extends \yii\db\ActiveRecord
{
    const STATUS_NOT_PUBLISHED = 0;
    const STATUS_PUBLISHED = 10;

    const EXECUTE_STATUS_TO_DO = 0;
    const EXECUTE_STATUS_IN_PROGRESS = 1;
    const EXECUTE_STATUS_ON_PAUSE = 2;
    const EXECUTE_STATUS_TESTING = 3;
    const EXECUTE_STATUS_TESTED = 4;
    const EXECUTE_STATUS_DONE = 5;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['date_start', 'date_end', 'created_at', 'updated_at'], 'safe'],
            [['status', 'department_id', 'level_id', 'execute_status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => function () {
                    return Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                },
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'name' => Yii::t('backend', 'Name'),
            'description' => Yii::t('backend', 'Description'),
            'date_start' => Yii::t('backend', 'Date Start'),
            'date_end' => Yii::t('backend', 'Date End'),
            'status' => Yii::t('backend', 'Status'),
            'department_id' => Yii::t('backend', 'Department ID'),
            'level_id' => Yii::t('backend', 'Level ID'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'execute_status' => Yii::t('backend', 'Execute status'),
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
     * @return mixed
     * @throws \Exception
     */
    public function getExecuteStatusLabel()
    {
        return ArrayHelper::getValue(static::getExecuteStatuses(), $this->execute_status);
    }

    /**
     * @return array
     */
    public static function getExecuteStatuses()
    {
        return [
            self::EXECUTE_STATUS_TO_DO     => Yii::t('backend', 'To do'),
            self::EXECUTE_STATUS_IN_PROGRESS => Yii::t('backend', 'In progress 2'),
            self::EXECUTE_STATUS_ON_PAUSE => Yii::t('backend', 'On pause'),
            self::EXECUTE_STATUS_TESTING => Yii::t('backend', 'Testing'),
            self::EXECUTE_STATUS_TESTED => Yii::t('backend', 'Tested'),
            self::EXECUTE_STATUS_DONE => Yii::t('backend', 'Done 2'),
        ];
    }


}
