<?php

use yii\db\Migration;

/**
 * Class m200805_121727_update_count_reviews_field
 */
class m200805_121727_update_count_reviews_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i = 1; $i < 21; $i++) {
            $this->update('statistic', ['count_reviews' => rand(0, 5)], 'id_user = ' . strval($i));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200805_121727_update_count_reviews_field cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200805_121727_update_count_reviews_field cannot be reverted.\n";

        return false;
    }
    */
}
