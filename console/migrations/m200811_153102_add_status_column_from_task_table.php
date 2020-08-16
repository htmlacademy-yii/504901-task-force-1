<?php

use yii\db\Migration;

/**
 * Class m200811_153102_add_status_column_from_task_table
 */
class m200811_153102_add_status_column_from_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'status', 'string');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200811_153102_add_status_column_from_task_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200811_153102_add_status_column_from_task_table cannot be reverted.\n";

        return false;
    }
    */
}
