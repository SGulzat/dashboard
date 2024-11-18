<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_comment".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $task_id
 * @property string $data
 * @property string $created_at Время создания
 * @property string $updated_at Время обновления
 */
class TaskComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'task_id'], 'integer'],
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
            'employee_id' => Yii::t('backend', 'Employee ID'),
            'task_id' => Yii::t('backend', 'Task ID'),
            'data' => Yii::t('backend', 'Data'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }
}
