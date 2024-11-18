<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m180825_070027_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->text(),
            'img'        => $this->string(),
            'status'  => $this->smallInteger(),
            'slug'    => $this->string(),
            'meta_description' => $this->string(),
            'meta_keywords' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('news');
    }
}
