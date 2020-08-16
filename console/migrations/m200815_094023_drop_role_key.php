<?php

use yii\db\Migration;

/**
 * Class m200815_094023_drop_role_key
 */
class m200815_094023_drop_role_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('profile_ibfk_3', 'profile');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200815_094023_drop_role_key cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200815_094023_drop_role_key cannot be reverted.\n";

        return false;
    }
    */
}
