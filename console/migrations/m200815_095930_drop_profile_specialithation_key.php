<?php

use yii\db\Migration;

/**
 * Class m200815_095930_drop_profile_specialithation_key
 */
class m200815_095930_drop_profile_specialithation_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-profile_specialization-profile_id', 'profile_specialization');
        $this->dropForeignKey('fk-profile_specialization-specialization_id', 'profile_specialization');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200815_095930_drop_profile_specialithation_key cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200815_095930_drop_profile_specialithation_key cannot be reverted.\n";

        return false;
    }
    */
}
