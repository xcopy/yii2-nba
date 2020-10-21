<?php

use app\models\Conference;

/* @var Conference[] $conferences */
/* @var Conference $conference */

?>

<div class="row">
    <?php foreach ($conferences as $conference): ?>
        <div class="col">
            <h1><?= $conference->name ?></h1>

            <?php foreach ($conference->divisions as $division): ?>
                <div class="card card-body mb-3">
                    <h4><?= $division->name ?></h4>

                    <ul class="list-unstyled">
                        <?php foreach ($division->teams as $team): ?>
                            <li><?= $team->name ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
