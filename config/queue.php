<?php

use yii\queue\file\Queue as FileQueue;
use yii\queue\db\Queue as DbQueue;
use yii\mutex\MysqlMutex;
use yii\queue\LogBehavior;

$configs = [
    'file' => [
        'class' => FileQueue::class,
        'as log' => LogBehavior::class
    ],
    'db' => [
        'class' => DbQueue::class,
        'db' => 'db',
        'tableName' => '{{%queue}}',
        'channel' => 'default',
        'mutex' => MysqlMutex::class,
        'as log' => LogBehavior::class
    ]
];

return $configs[env('QUEUE_DRIVER')];
