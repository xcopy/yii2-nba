<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%conference}}`.
 */
class m201021_093748_create_conferences_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%conference}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(100)->notNull()
        ]);

        $this->batchInsert(
            '{{%conference}}',
            ['name'],
            [
                ['Western Conference'],
                ['Eastern Conference']
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%conference}}');
    }
}
