<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%developer_level}}`.
 */
class m241029_120736_create_developer_level_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%developer_level}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Имя'),
            'description' => $this->text()->comment('Описание'),
            'status' => $this->tinyInteger()->null()->comment('Статус'),
            'level_number' => $this->tinyInteger()->null()->comment('Уровень в цифрах'),
            'created_at' => $this->dateTime()->comment('Время создания'),
            'updated_at' => $this->dateTime()->comment('Время обновления'),
        ]);

        $dateTime = Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
        // Данные для вставки
        $rows = [
            ['Junior', 'Младщий разработчик', 10, 0, $dateTime, $dateTime],
            ['Middle', 'Средний разработчик', 10, 1, $dateTime, $dateTime],
            ['Senior', 'Старщий разработчик', 10, 2, $dateTime, $dateTime],
        ];

        // Выполнение batchInsert
        Yii::$app->db->createCommand()->batchInsert('developer_level', ['name', 'description', 'status', 'level_number', 'created_at', 'updated_at'], $rows)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%developer_level}}');
    }
}
