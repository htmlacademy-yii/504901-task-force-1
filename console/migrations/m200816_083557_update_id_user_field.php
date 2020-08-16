<?php

use yii\db\Migration;

/**
 * Class m200816_083557_update_id_user_field
 */
class m200816_083557_update_id_user_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i = 1; $i < 11; $i++) {
            $this->update('review', ['id_user' => rand(10, 20)], 'id_review = ' . strval($i));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200816_083557_update_id_user_field cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200816_083557_update_id_user_field cannot be reverted.\n";

        return false;
    }
    */
}
