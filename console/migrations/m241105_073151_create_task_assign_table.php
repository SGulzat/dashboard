<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_assign}}`.
 */
class m241105_073151_create_task_assign_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_assign}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->comment('ID задачи'),
            'employee_id' => $this->integer()->comment('ID сотрудника'),
            'data' => $this->text()->comment('Дополнительные данные'),
            'status' => $this->integer()->comment('Статус задач'),
            'created_at' => $this->dateTime()->comment('Время создания'),
            'updated_at' => $this->dateTime()->comment('Время обновления'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task_assign}}');
    }
}
