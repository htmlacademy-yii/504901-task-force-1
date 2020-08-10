<?php

use yii\db\Migration;

/**
 * Class m200803_084032_insert_into_specialization
 */
class m200803_084032_insert_into_specialization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('specialization', ['name'], [
            ['Курьерские услуги'],
            ['Грузоперевозки'],
            ['Перевод текстов'],
            ['Ремонт транспорта'],
            ['Удалённая помощь'],
            ['Выезд на стрелку']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200803_084032_insert_into_specialization cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200803_084032_insert_into_specialization cannot be reverted.\n";

        return false;
    }
    */
}
