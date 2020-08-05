<?php

use yii\db\Migration;

/**
 * Class m200805_071528_insert_into_statistic
 */
class m200805_071528_insert_into_statistic extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i = 1; $i < 21; $i++) {
            $this->insert('statistic',
                ['id_user' => $i,
                    'rating' => rand(100, 500) / 100,
                    'count_tasks' => rand(1, 5),
                    'count_views' => rand(1, 5),
                    'count_fail' => rand(0, 3)
                ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200805_071528_insert_into_statistic cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200805_071528_insert_into_statistic cannot be reverted.\n";

        return false;
    }
    */
}
