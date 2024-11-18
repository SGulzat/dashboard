<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%department}}`.
 */
class m241028_165736_create_department_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%department}}', [
            'id' => $this->primaryKey()->comment('ID задачи из системы'),
            'name' => $this->string()->comment('Имя отдела'),
            'description' => $this->text()->comment('Описание отдела'),
            'status' => $this->tinyInteger()->null()->comment('Статус'),
            'created_at' => $this->dateTime()->comment('Время создания'),
            'updated_at' => $this->dateTime()->comment('Время обновления'),
        ]);

        $dateTime = Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
        // Данные для вставки
        $rows = [
            ['IT отдел', 'IT отдел', 10, $dateTime, $dateTime],
            ['Отдел маркетинга', 'Отдел маркетинга', 10, $dateTime, $dateTime],
            ['HR отдел', 'HR отдел', 10, $dateTime, $dateTime],
            ['Отдел финансов', 'Отдел финансов', 10, $dateTime, $dateTime],
        ];

        // Выполнение batchInsert
        Yii::$app->db->createCommand()->batchInsert('department', ['name', 'description', 'status', 'created_at', 'updated_at'], $rows)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%department}}');
    }
}
