<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%review}}`.
 */
class m200816_082728_drop_id_task_column_from_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('review', 'id_task');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
