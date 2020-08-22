<?php

use yii\db\Migration;

/**
 * Class m200816_082147_drop_task_key
 */
class m200816_082147_drop_task_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('review_ibfk_1', 'review');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200816_082147_drop_task_key cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200816_082147_drop_task_key cannot be reverted.\n";

        return false;
    }
    */
}
