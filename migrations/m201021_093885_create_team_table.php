<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%team}}`.
 */
class m201021_093885_create_team_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%team}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(100)->notNull(),
            'division_id' => $this->integer()->unsigned()->notNull()
        ]);

        $this->createIndex(
            'idx-team-division_id',
            'team',
            'division_id'
        );

        $this->addForeignKey(
            'fk-team-division_id',
            'team',
            'division_id',
            'division',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->batchInsert(
            '{{%team}}',
            ['name', 'division_id'],
            [
                ['Denver Nuggets', 1],
                ['Minnesota Timberwolves', 1],
                ['Oklahoma City Thunder', 1],
                ['Portland Trail Blazers', 1],
                ['Utah Jazz', 1],

                ['Golden State Warriors', 2],
                ['Los Angeles Clippers', 2],
                ['Los Angeles Lakers', 2],
                ['Phoenix Suns', 2],
                ['Sacramento Kings', 2],

                ['Dallas Mavericks', 3],
                ['Houston Rockets', 3],
                ['Memphis Grizzlies', 3],
                ['New Orleans Pelicans', 3],
                ['San Antonio Spurs', 3],

                ['Atlanta Hawks', 4],
                ['Charlotte Hornets', 4],
                ['Miami Heat', 4],
                ['Orlando Magic', 4],
                ['Washington Wizards', 4],

                ['Chicago Bulls', 5],
                ['Cleveland Cavaliers', 5],
                ['Detroit Pistons', 5],
                ['Indiana Pacers', 5],
                ['Milwaukee Bucks', 5],

                ['Boston Celtics', 6],
                ['Brooklyn Nets', 6],
                ['New York Knicks', 6],
                ['Philadelphia 76ers', 6],
                ['Toronto Raptors', 6]
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-team-division_id','team');

        $this->dropIndex('idx-team-division_id','team');

        $this->dropTable('{{%team}}');
    }
}
