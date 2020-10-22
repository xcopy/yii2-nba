<?php

use app\models\Team;
/** @var Team $team */
$formatter = Yii::$app->formatter;

?>

<h1><?= $team->name ?></h1>

<?php foreach ($team->players as $player): ?>
    <h3><?= $player->name ?></h3>
    <table>
        <tbody>
            <tr>
                <td style="width: 100px;">Born</td>
                <td><?= $formatter->asDate($player->born_at, 'long') ?></td>
            </tr>
            <tr>
                <td>Age</td>
                <td>
                    <?php
                        $origin = date_create($player->born_at);
                        $target = date_create('now');
                        $interval = date_diff($origin, $target);
                    ?>
                    <?= $interval->format('%y') ?> years
                </td>
            </tr>
            <tr>
                <td>From</td>
                <td><?= $player->from ?></td>
            </tr>
            <tr>
                <td>Height</td>
                <td><?= $player->height ?> cm</td>
            </tr>
            <tr>
                <td>Weight</td>
                <td><?= $player->weight ?> kg</td>
            </tr>
            <tr>
                <td>Drafted</td>
                <td><?= $formatter->asDate($player->drafted_at, 'long') ?></td>
            </tr>
        </tbody>
    </table>
    <hr>
<?php endforeach; ?>
