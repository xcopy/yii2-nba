<?php

use yii\db\Migration;
use Faker\Factory as FakerFactory;

/**
 * Handles the creation of table `{{%manager}}`.
 */
class m201021_120353_create_manager_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%manager}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull()->unique(),
            'team_id' => $this->integer()->unsigned()->notNull()
        ]);

        $this->createIndex(
            'idx-manager-team_id',
            'manager',
            'team_id'
        );

        $this->addForeignKey(
            'fk-manager-team_id',
            'manager',
            'team_id',
            'team',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $faker = FakerFactory::create();

        for ($i = 1; $i <= 30; $i++) {
            $this->insert('{{%manager}}', [
                'name' => $faker->name('male'),
                'email' => $faker->email,
                'team_id' => $i
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-manager-team_id','manager');

        $this->dropIndex('idx-manager-team_id','manager');

        $this->dropTable('{{%manager}}');
    }
}
