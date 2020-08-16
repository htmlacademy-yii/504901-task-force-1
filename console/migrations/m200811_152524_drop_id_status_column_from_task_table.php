<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%task}}`.
 */
class m200811_152524_drop_id_status_column_from_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('task', 'id_status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('task', 'id_status', 'int');
    }
}
