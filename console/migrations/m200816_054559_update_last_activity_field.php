<?php

use yii\db\Migration;

/**
 * Class m200816_054559_update_last_activity_field
 */
class m200816_054559_update_last_activity_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i = 1; $i < 21; $i++) {
            $this->update('user', ['last_activity' => time() - $i * rand(100, 1000)], 'id_user = ' . strval($i));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200816_054559_update_last_activity_field cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200816_054559_update_last_activity_field cannot be reverted.\n";

        return false;
    }
    */
}
