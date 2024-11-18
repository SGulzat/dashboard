<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "task_assign".
 *
 * @property int $id
 * @property int $task_id ID задачи
 * @property int $employee_id ID сотрудника
 * @property string $data Дополнительные данные
 * @property int $status Статус задач
 * @property string $created_at Время создания
 * @property string $updated_at Время обновления
 */
class TaskAssign extends \yii\db\ActiveRecord
{
    const STATUS_WAITING = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_IN_DONE = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_assign';
    }

    /**
     * @return array
     */
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
    public function rules()
    {
        return [
            [['task_id', 'employee_id', 'status'], 'integer'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'task_id' => Yii::t('backend', 'Task ID'),
            'employee_id' => Yii::t('backend', 'Employee ID'),
            'data' => Yii::t('backend', 'Data'),
            'status' => Yii::t('backend', 'Status'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
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
            self::STATUS_WAITING     => Yii::t('backend', 'Waiting'),
            self::STATUS_IN_PROGRESS => Yii::t('backend', 'In progress'),
            self::STATUS_IN_DONE => Yii::t('backend', 'Done'),
        ];
    }
}
