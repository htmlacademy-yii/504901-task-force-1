<?php

use yii\db\Migration;

/**
 * Class m200816_083203_add_id_user_column_to_review_tablele
 */
class m200816_083203_add_id_user_column_to_review_tablele extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('review', 'id_user', 'integer');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200816_083203_add_id_user_column_to_review_tablele cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200816_083203_add_id_user_column_to_review_tablele cannot be reverted.\n";

        return false;
    }
    */
}
