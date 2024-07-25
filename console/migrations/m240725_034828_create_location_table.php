<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%location}}`.
 */
class m240725_034828_create_location_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%location}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string()->notNull(),
            'latitude' => $this->float()->notNull(),
            'longitude' => $this->float()->notNull(),
            'task_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `task_id`
        $this->createIndex(
            'idx-location-task_id',
            'location',
            'task_id'
        );

        // add foreign key for table `task`
        $this->addForeignKey(
            'fk-location-task_id',
            'location',
            'task_id',
            'task',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-location-task_id',
            'location'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            'idx-location-task_id',
            'location'
        );

        $this->dropTable('{{%location}}');
    }
}
