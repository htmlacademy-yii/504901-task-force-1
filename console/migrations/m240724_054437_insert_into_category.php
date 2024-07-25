<?php

use yii\db\Migration;

/**
 * Class m240724_054437_insert_into_category
 */
class m240724_054437_insert_into_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = ['name', 'icon'];
        $rows = [
            ['Переводы','translation'],
            ['Уборка','clean'],
            ['Переезды','cargo'],
            ['Компьютерная помощь','neo'],
            ['Ремонт квартирный','flat'],
            ['Ремонт техники','repair'],
            ['Красота','beauty'],
            ['Фото','photo'],
        ];

        $this->batchInsert('category', $columns, $rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240724_054437_insert_into_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240724_054437_insert_into_category cannot be reverted.\n";

        return false;
    }
    */
}
