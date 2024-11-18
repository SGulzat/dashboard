<?php

use yii\db\Migration;

/**
 * Class m241111_182310_add_execute_status_table_to_tasks_table
 */
class m241111_182310_add_execute_status_table_to_tasks_table extends Migration
{
    public $tableName = '{{%tasks}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'execute_status', $this->tinyInteger()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'execute_status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241111_182310_add_execute_status_table_to_tasks_table cannot be reverted.\n";

        return false;
    }
    */
}
