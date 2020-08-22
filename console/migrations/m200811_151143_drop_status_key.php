<?php

use yii\db\Migration;

/**
 * Class m200811_151143_drop_status_key
 */
class m200811_151143_drop_status_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('task_ibfk_1', 'task');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200811_151143_drop_status_key cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200811_151143_drop_status_key cannot be reverted.\n";

        return false;
    }
    */
}
