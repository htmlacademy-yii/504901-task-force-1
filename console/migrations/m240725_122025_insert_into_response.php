<?php

use yii\db\Migration;

/**
 * Class m240725_122025_insert_into_response
 */
class m240725_122025_insert_into_response extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = ['cost', 'task_id', 'user_id', 'message'];
        $rows = [
            [1500, 2, 4, 'Могу сделать всё в лучшем виде. У меня есть необходимый опыт и инструменты.'],
            [1500, 2, 3, 'Примусь за выполнение задания в течение часа, сделаю быстро и качественно.']
        ];

        $this->batchInsert('response', $columns, $rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240725_122025_insert_into_response cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240725_122025_insert_into_response cannot be reverted.\n";

        return false;
    }
    */
}
