<?php

use yii\db\Migration;

/**
 * Class m200804_041135_update_avatar_fild
 */
class m200804_041135_update_avatar_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i = 1; $i < 21; $i++) {
            $avatar = ['man-glasses.jpg', 'user-man.jpg', 'user-man2.jpg'];
            $index = rand(0, 2);
            $this->update('profile', ['avatar' => "$avatar[$index]"], 'id_user = ' . strval($i));
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200804_041135_update_avatar_fild cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200804_041135_update_avatar_fild cannot be reverted.\n";

        return false;
    }
    */
}
