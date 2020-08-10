<?php

use yii\db\Migration;

/**
 * Class m200803_082651_drop_table_specialization
 */
class m200803_082651_drop_table_specialization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('specialization');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200803_082651_drop_table_specialization cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200803_082651_drop_table_specialization cannot be reverted.\n";

        return false;
    }
    */
}
