<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employees}}`.
 */
class m241029_133550_create_employees_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employees}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->comment('ФИО'),
            'description' => $this->text()->comment('Описание'),
            'status' => $this->tinyInteger()->null()->comment('Статус'),
            'department_id' => $this->tinyInteger()->null()->comment('Отдел id'),
            'level_id' => $this->tinyInteger()->null()->comment('Уровень id'),
            'image' => $this->string()->comment('Фото'),
            'created_at' => $this->dateTime()->comment('Время создания'),
            'updated_at' => $this->dateTime()->comment('Время обновления'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employees}}');
    }
}
