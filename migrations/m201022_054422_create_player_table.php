<?php

use yii\db\Migration;
use Faker\Factory as FakerFactory;

/**
 * Handles the creation of table `{{%player}}`.
 */
class m201022_054422_create_player_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%player}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(100)->notNull(),
            'from' => $this->string(100)->notNull(),
            'height' => $this->double()->notNull(),
            'weight' => $this->double()->notNull(),
            'born_at' => $this->date()->notNull(),
            'drafted_at' => $this->date()->notNull(),
            'team_id' => $this->integer()->unsigned()->notNull()
        ]);

        $this->createIndex(
            'idx-player-team_id',
            'player',
            'team_id'
        );

        $this->addForeignKey(
            'fk-player-team_id',
            'player',
            'team_id',
            'team',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $faker = FakerFactory::create();

        for ($i = 1; $i <= 30; $i++) {
            for ($j = 1; $j <= 15; $j++) {
                $height = $faker->randomFloat(2, 190, 210);

                $this->insert('{{%player}}', [
                    'name' => $faker->firstNameMale.' '.$faker->lastName,
                    'from' => $faker->city,
                    'height' => $height,
                    'weight' => $height - 100,
                    'born_at' => $faker->dateTimeBetween('-35 years', '-18 years')->format('Y-m-d'),
                    'drafted_at' => $faker->dateTimeBetween('-15 years')->format('Y-m-d'),
                    'team_id' => $i
                ]);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-player-team_id','player');

        $this->dropIndex('idx-player-team_id','player');

        $this->dropTable('{{%player}}');
    }
}
