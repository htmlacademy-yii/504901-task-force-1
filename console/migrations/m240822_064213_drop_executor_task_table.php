<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%executor_task}}`.
 */
class m240822_064213_drop_executor_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%executor_task}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%executor_task}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
