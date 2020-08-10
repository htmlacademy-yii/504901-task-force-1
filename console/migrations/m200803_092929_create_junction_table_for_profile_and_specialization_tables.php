<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profile_specialization}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%profile}}`
 * - `{{%specialization}}`
 */
class m200803_092929_create_junction_table_for_profile_and_specialization_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profile_specialization}}', [
            'profile_id' => $this->integer(),
            'specialization_id' => $this->integer(),
            'PRIMARY KEY(profile_id, specialization_id)',
        ]);

        // creates index for column `profile_id`
        $this->createIndex(
            '{{%idx-profile_specialization-profile_id}}',
            '{{%profile_specialization}}',
            'profile_id'
        );

        // add foreign key for table `{{%profile}}`
        $this->addForeignKey(
            '{{%fk-profile_specialization-profile_id}}',
            '{{%profile_specialization}}',
            'profile_id',
            '{{%profile}}',
            'id_user',
            'CASCADE'
        );

        // creates index for column `specialization_id`
        $this->createIndex(
            '{{%idx-profile_specialization-specialization_id}}',
            '{{%profile_specialization}}',
            'specialization_id'
        );

        // add foreign key for table `{{%specialization}}`
        $this->addForeignKey(
            '{{%fk-profile_specialization-specialization_id}}',
            '{{%profile_specialization}}',
            'specialization_id',
            '{{%specialization}}',
            'id',
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
            '{{%fk-profile_specialization-profile_id}}',
            '{{%profile_specialization}}'
        );

        // drops index for column `profile_id`
        $this->dropIndex(
            '{{%idx-profile_specialization-profile_id}}',
            '{{%profile_specialization}}'
        );

        // drops foreign key for table `{{%specialization}}`
        $this->dropForeignKey(
            '{{%fk-profile_specialization-specialization_id}}',
            '{{%profile_specialization}}'
        );

        // drops index for column `specialization_id`
        $this->dropIndex(
            '{{%idx-profile_specialization-specialization_id}}',
            '{{%profile_specialization}}'
        );

        $this->dropTable('{{%profile_specialization}}');
    }
}
