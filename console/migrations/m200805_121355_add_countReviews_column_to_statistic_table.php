<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%statistic}}`.
 */
class m200805_121355_add_countreviews_column_to_statistic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%statistic}}', 'count_reviews', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%statistic}}', 'count_reviews');
    }
}
