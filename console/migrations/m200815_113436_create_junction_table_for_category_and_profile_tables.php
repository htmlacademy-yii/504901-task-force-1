<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_profile}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%category}}`
 * - `{{%profile}}`
 */
class m200815_113436_create_junction_table_for_category_and_profile_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_profile}}', [
            'category_id' => $this->integer(),
            'profile_id' => $this->integer(),
            'PRIMARY KEY(category_id, profile_id)',
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-category_profile-category_id}}',
            '{{%category_profile}}',
            'category_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-category_profile-category_id}}',
            '{{%category_profile}}',
            'category_id',
            '{{%category}}',
            'id_category',
            'CASCADE'
        );

        // creates index for column `profile_id`
        $this->createIndex(
            '{{%idx-category_profile-profile_id}}',
            '{{%category_profile}}',
            'profile_id'
        );

        // add foreign key for table `{{%profile}}`
        $this->addForeignKey(
            '{{%fk-category_profile-profile_id}}',
            '{{%category_profile}}',
            'profile_id',
            '{{%profile}}',
            'id_user',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-category_profile-category_id}}',
            '{{%category_profile}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-category_profile-category_id}}',
            '{{%category_profile}}'
        );

        // drops foreign key for table `{{%profile}}`
        $this->dropForeignKey(
            '{{%fk-category_profile-profile_id}}',
            '{{%category_profile}}'
        );

        // drops index for column `profile_id`
        $this->dropIndex(
            '{{%idx-category_profile-profile_id}}',
            '{{%category_profile}}'
        );

        $this->dropTable('{{%category_profile}}');
    }
}
