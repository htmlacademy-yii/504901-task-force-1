<?php

use yii\db\Migration;

/**
 * Class m200830_015138_insert_into_profile_task
 */
class m200830_015138_insert_into_profile_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('profile_task',
            [
                'profile_id' => 10,
                'task_id' => 4,
                'cost' => 1500,
                'message' => "Могу сделать всё в лучшем виде. У меня есть необходимый опыт и инструменты.",
                'created_at' => time() - rand(1000, 10000),
            ]);
        $this->insert('profile_task',
            [
                'profile_id' => 11,
                'task_id' => 4,
                'cost' => 1500,
                'message' => "Примусь за выполнение задания в течение часа, сделаю быстро и качественно.",
                'created_at' => time() - rand(1000, 10000),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200830_015138_insert_into_profile_task cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200830_015138_insert_into_profile_task cannot be reverted.\n";

        return false;
    }
    */
}
