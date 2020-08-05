<?php

use yii\db\Migration;

/**
 * Class m200803_083029_create_table_specialization
 */
class m200803_083029_create_table_specialization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('specialization', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200803_083029_create_table_specialization cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200803_083029_create_table_specialization cannot be reverted.\n";

        return false;
    }
    */
}
