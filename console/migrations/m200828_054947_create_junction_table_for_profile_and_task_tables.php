<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profile_task}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%profile}}`
 * - `{{%task}}`
 */
class m200828_054947_create_junction_table_for_profile_and_task_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profile_task}}', [
            'profile_id' => $this->integer(),
            'task_id' => $this->integer(),
            'cost' => $this->integer(),
            'message' => $this->text(),
            'status' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'PRIMARY KEY(profile_id, task_id)',
        ]);

        // creates index for column `profile_id`
        $this->createIndex(
            '{{%idx-profile_task-profile_id}}',
            '{{%profile_task}}',
            'profile_id'
        );

        // add foreign key for table `{{%profile}}`
        $this->addForeignKey(
            '{{%fk-profile_task-profile_id}}',
            '{{%profile_task}}',
            'profile_id',
            '{{%profile}}',
            'id_user',
            'CASCADE'
        );

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-profile_task-task_id}}',
            '{{%profile_task}}',
            'task_id'
        );

        // add foreign key for table `{{%task}}`
        $this->addForeignKey(
            '{{%fk-profile_task-task_id}}',
            '{{%profile_task}}',
            'task_id',
            '{{%task}}',
            'id_task',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%profile}}`
        $this->dropForeignKey(
            '{{%fk-profile_task-profile_id}}',
            '{{%profile_task}}'
        );

        // drops index for column `profile_id`
        $this->dropIndex(
            '{{%idx-profile_task-profile_id}}',
            '{{%profile_task}}'
        );

        // drops foreign key for table `{{%task}}`
        $this->dropForeignKey(
            '{{%fk-profile_task-task_id}}',
            '{{%profile_task}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-profile_task-task_id}}',
            '{{%profile_task}}'
        );

        $this->dropTable('{{%profile_task}}');
    }
}
