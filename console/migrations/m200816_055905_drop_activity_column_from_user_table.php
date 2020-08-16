<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%user}}`.
 */
class m200816_055905_drop_activity_column_from_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user', 'activity');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
