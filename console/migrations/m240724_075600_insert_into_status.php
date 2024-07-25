<?php

use yii\db\Migration;

/**
 * Class m240724_075600_insert_into_status
 */
class m240724_075600_insert_into_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = ['name', 'translation'];
        $rows = [
            ['new', 'Новое'],
            ['canceled', 'Отменено'],
            ['in_work', 'В работе'],
            ['performed', 'Выполнено'],
            ['failed', 'Провалено'],
            
        ];

        $this->batchInsert('status', $columns, $rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240724_075600_insert_into_status cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240724_075600_insert_into_status cannot be reverted.\n";

        return false;
    }
    */
}
