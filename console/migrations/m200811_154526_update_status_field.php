<?php

use yii\db\Migration;

/**
 * Class m200811_154526_update_status_field
 */
class m200811_154526_update_status_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $status = ['new', 'canceled', 'in_work', 'performed', 'failed'];
        for ($i = 0; $i < 10; $i++) {
            $index = rand(0, 4);
            $this->update('task', ['status' => $status[$index]], 'id_task = ' . strval($i));
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200811_154526_update_status_field cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200811_154526_update_status_field cannot be reverted.\n";

        return false;
    }
    */
}
