<?php

use yii\db\Migration;

/**
 * Class m200725_064323_update_activity_field
 */
class m200725_064323_update_activity_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i = 1; $i < 21; $i++) {
            $time = Yii::$app->formatter->asDatetime(time() - $i * rand(1000, 100000), "yyyy-MM-dd HH:mm");
            $this->update('user', ['activity' => "$time"], 'id_user = ' . strval($i));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200725_064323_update_activity_field cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200725_064323_update_activity_field cannot be reverted.\n";

        return false;
    }
    */
}
