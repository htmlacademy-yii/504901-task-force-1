<?php

use yii\db\Migration;

/**
 * Class m240724_080420_insert_into_task
 */
class m240724_080420_insert_into_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = ['status_id', 'name_task', 'category_id', 'description', 'budget', 'owner_id'];
        $rows = [
            [1,'Перевести войну и мир на клингонский', 1, 'Значимость очевидна…', random_int(5000, 10000), 5],
            [1,'Убраться в квартире', 2, 'Значимость очевидна…', random_int(5000, 10000), 5],
            [1,'Перевезти груз', 3, 'Значимость очевидна…', random_int(5000, 10000), 5],
            
        ];

        $this->batchInsert('task', $columns, $rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240724_080420_insert_into_task cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240724_080420_insert_into_task cannot be reverted.\n";

        return false;
    }
    */
}
