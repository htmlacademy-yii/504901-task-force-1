<?php

use yii\db\Migration;

/**
 * Class m200815_114219_insert_into_category_profile
 */
class m200815_114219_insert_into_category_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i = 10; $i < 21; $i++) {
            $count = rand(1, 3);
            $categories = [];
            while ($count) {
                $category = rand(1, 8);
                if (in_array($category, $categories)) {
                    break;
                }
                $categories[] = $category;
                $this->insert('category_profile',
                    [
                        'category_id' => $category,
                        'profile_id' => $i,
                    ]);
                $count--;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200815_114219_insert_into_category_profile cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200815_114219_insert_into_category_profile cannot be reverted.\n";

        return false;
    }
    */
}
