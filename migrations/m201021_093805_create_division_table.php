<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%division}}`.
 */
class m201021_093805_create_division_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%division}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(100)->notNull(),
            'conference_id' => $this->integer()->unsigned()->notNull()
        ]);

        $this->createIndex(
            'idx-division-conference_id',
            'division',
            'conference_id'
        );

        $this->addForeignKey(
            'fk-division-conference_id',
            'division',
            'conference_id',
            'conference',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->batchInsert(
            '{{%division}}',
            ['name', 'conference_id'],
            [
                ['Northwest', 1],
                ['Pacific', 1],
                ['Southwest', 1],
                ['Southeast', 2],
                ['Central', 2],
                ['Atlantic', 2]
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-division-conference_id', 'division');

        $this->dropIndex('idx-division-conference_id', 'division');

        $this->dropTable('{{%division}}');
    }
}
