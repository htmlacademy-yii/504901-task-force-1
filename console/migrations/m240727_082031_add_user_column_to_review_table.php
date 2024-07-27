<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%review}}`.
 */
class m240727_082031_add_user_column_to_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%review}}', 'user_id', $this->integer()->notNull());

        $this->createIndex(
            'idx-review-user_id',
            'review',
            'user_id'
        );

        $this->addForeignKey(
            'fk-review-user_id',
            'review',
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
        $this->dropForeignKey(
            'fk-review-user_id',
            'review'
        );

        $this->dropIndex(
            'idx-review-user_id',
            'review'
        );

        $this->dropColumn('{{%review}}', 'user_id');
    }
}
