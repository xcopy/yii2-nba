<?php

use yii\queue\file\Queue;
use yii\queue\LogBehavior;

return [
    'class' => Queue::class,
    'as log' => LogBehavior::class
];
