<?php

namespace frontend\models;

use common\models\TaskComment;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class TaskCommentForm extends Model
{
    public $employee_id;
    public $task_id;
    public $data;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'task_id'], 'integer'],
            [['data'], 'string'],
            [['data'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'data' => 'Данные',
        ];
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function save()
    {
//        if ($this->validate()) {
//            print_r($this->getFirstErrors());
//        }

        $taskComment = new TaskComment();
        $taskComment->attributes = $this->attributes;
        if ($taskComment->save()) {
            return true;
        } else {
            return false;
        }
    }
}
