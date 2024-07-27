<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work}}`.
 */
class m240727_072358_create_work_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work}}', [
            'id' => $this->primaryKey(),
            'photo' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-work-user_id',
            'work',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-work-user_id',
            'work',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-work-user_id',
            'work'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-work-user_id',
            'work'
        );
        
        $this->dropTable('{{%work}}');
    }
}
