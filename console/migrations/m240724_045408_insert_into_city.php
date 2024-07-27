<?php

use yii\db\Migration;

/**
 * Class m240724_045408_insert_into_city
 */
class m240724_045408_insert_into_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    
    public function safeUp()
    {
        $columns = ['name', 'latitude', 'longitude'];
        $rows = [
            ['Москва','55.442407','37.363648'],
            ['Санкт-Петербург','59.571163','30.198823'],
            ['Екатеринбург','56.8386326','60.6054887'],
            ['Иркутск','52.2863513','104.280655'],
            ['Владивосток','43.1163807','131.882348'],
        ];

        $this->batchInsert('city', $columns, $rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240724_045408_insert_into_city cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240724_045408_insert_into_city cannot be reverted.\n";

        return false;
    }
    */
}
