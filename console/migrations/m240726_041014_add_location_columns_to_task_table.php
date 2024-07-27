<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%task}}`.
 */
class m240726_041014_add_location_columns_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%task}}', 'address', $this->string());
        $this->addColumn('{{%task}}', 'latitude', $this->float());
        $this->addColumn('{{%task}}', 'longitude', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%task}}', 'address');
        $this->dropColumn('{{%task}}', 'latitude');
        $this->dropColumn('{{%task}}', 'longitude');
    }
}
