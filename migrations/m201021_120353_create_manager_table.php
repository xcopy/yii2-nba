<?php

use yii\db\Migration;
use Faker\Factory as FakerFactory;
use app\models\Team;

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

        /** @var Team $team */
        foreach (Team::find()->all() as $team) {
            $this->insert('{{%manager}}', [
                'name' => $faker->name('male'),
                'email' => $faker->email,
                'team_id' => $team->primaryKey
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
