<?php

use yii\db\Migration;

/**
 * Class m240725_043755_insert_into_specialization
 */
class m240725_043755_insert_into_specialization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = ['user_id', 'category_id'];
        $rows = [
            [1,1],
            [1,2],
            [1,5],
            [2,6],
            [2,4],
            [3,2],
            [3,3],
            [3,8],
            [4,7],
            [4,4],

        ];

        $this->batchInsert('specialization', $columns, $rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240725_043755_insert_into_specialization cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240725_043755_insert_into_specialization cannot be reverted.\n";

        return false;
    }
    */
}
