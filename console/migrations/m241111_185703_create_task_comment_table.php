<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_comment}}`.
 */
class m241111_185703_create_task_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_comment}}', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer(),
            'task_id' => $this->integer(),
            'data' => $this->text(),
            'created_at' => $this->dateTime()->comment('Время создания'),
            'updated_at' => $this->dateTime()->comment('Время обновления'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task_comment}}');
    }
}
