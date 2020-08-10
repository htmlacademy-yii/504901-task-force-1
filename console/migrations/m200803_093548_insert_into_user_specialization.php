<?php

use yii\db\Migration;

/**
 * Class m200803_093548_insert_into_user_specialization
 */
class m200803_093548_insert_into_user_specialization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i = 1; $i < 21; $i++) {
            $this->insert('profile_specialization', ['profile_id' => $i, 'specialization_id' => rand(1, 6)]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200803_093548_insert_into_user_specialization cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200803_093548_insert_into_user_specialization cannot be reverted.\n";

        return false;
    }
    */
}
