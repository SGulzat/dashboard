<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks}}`.
 */
class m241029_142220_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Название'),
            'description' => $this->text()->comment('Описание'),
            'date_start' => $this->dateTime()->comment('Время начало'),
            'date_end' => $this->dateTime()->comment('Время окончание'),
            'status' => $this->tinyInteger()->null()->comment('Статус'),
            'department_id' => $this->tinyInteger()->null()->comment('Отдел id'),
            'level_id' => $this->tinyInteger()->null()->comment('Уровень id'),
            'created_at' => $this->dateTime()->comment('Время создания'),
            'updated_at' => $this->dateTime()->comment('Время обновления'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tasks}}');
    }
}
