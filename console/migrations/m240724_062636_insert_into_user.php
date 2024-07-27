<?php

use yii\db\Migration;

/**
 * Class m240724_062636_insert_into_user
 */
class m240724_062636_insert_into_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = ['email', 'password', 'name', 'city_id', 'role'];
        $rows = [
            ['kumarm@mail.ru',Yii::$app->getSecurity()->generatePasswordHash('12345'),'Мамедов Кумар', 2, 'executor'],
            ['amironovm@mail.ru',Yii::$app->getSecurity()->generatePasswordHash('12345'),'Миронов Алексей', 1, 'executor'],
            ['vkrjukm@mail.ru',Yii::$app->getSecurity()->generatePasswordHash('12345'),'Крючков Василий', 3, 'executor'],
            ['pastax@mail.ru',Yii::$app->getSecurity()->generatePasswordHash('12345'),'Астахов Павел', 2, 'executor'],
            ['vasja@mail.ru',Yii::$app->getSecurity()->generatePasswordHash('12345'),'Василий', 3, 'customer'],
        ];

        $this->batchInsert('user', $columns, $rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240724_062636_insert_into_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240724_062636_insert_into_user cannot be reverted.\n";

        return false;
    }
    */
}
