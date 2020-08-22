<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%profile_specialization}}`.
 */
class m200815_100847_drop_profile_specialization_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%profile_specialization}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%profile_specialization}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
