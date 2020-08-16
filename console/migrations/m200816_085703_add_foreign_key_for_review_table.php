<?php

use yii\db\Migration;

/**
 * Class m200816_085703_add_foreign_key_for_review_table
 */
class m200816_085703_add_foreign_key_for_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            '{{%idx-review-id_user}}',
            '{{%review}}',
            'id_user'
        );

        // add foreign key for table `{{%review}}`
        $this->addForeignKey(
            '{{%fk-review-id_user}}',
            '{{%review}}',
            'id_user',
            '{{%profile}}',
            'id_user',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200816_085703_add_foreign_key_for_review_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200816_085703_add_foreign_key_for_review_table cannot be reverted.\n";

        return false;
    }
    */
}
