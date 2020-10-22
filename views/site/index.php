<?php

use app\models\Conference;
use yii\helpers\Inflector;

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
                            <li class="d-flex align-items-center my-3">
                                <div class="mr-3" style="width: 50px; height: 50px; background: url('/storage/<?= Inflector::slug($team->name, '_', false) ?>/Logo/Logo-0.png') center / contain no-repeat"></div>
                                <h6 class="m-0"><?= $team->name ?></h6>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
