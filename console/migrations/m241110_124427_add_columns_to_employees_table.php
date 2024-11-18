<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%employees}}`.
 */
class m241110_124427_add_columns_to_employees_table extends Migration
{
    public $tableName = '{{%employees}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'username', $this->string());
        $this->addColumn($this->tableName, 'email', $this->string());
        $this->addColumn($this->tableName, 'phone', $this->string());
        $this->addColumn($this->tableName, 'access_status', $this->smallInteger()->notNull()->defaultValue(10));
        $this->addColumn($this->tableName, 'auth_key', $this->string(32)->notNull());
        $this->addColumn($this->tableName, 'password_hash', $this->string()->notNull());
        $this->addColumn($this->tableName, 'password_reset_token', $this->string()->unique());
        $this->addColumn($this->tableName, 'password', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'username');
        $this->dropColumn($this->tableName, 'email');
        $this->dropColumn($this->tableName, 'phone');
        $this->dropColumn($this->tableName, 'access_status');
        $this->dropColumn($this->tableName, 'auth_key');
        $this->dropColumn($this->tableName, 'password_hash');
        $this->dropColumn($this->tableName, 'password_reset_token');
        $this->dropColumn($this->tableName, 'password');
    }
}
