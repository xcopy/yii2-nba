<?php

use yii\queue\file\Queue as FileQueue;
use yii\queue\db\Queue as DbQueue;
use yii\queue\redis\Queue as RedisQueue;
use yii\mutex\MysqlMutex;
use yii\queue\LogBehavior;

$configs = [
    'file' => [
        'class' => FileQueue::class
    ],
    'db' => [
        'class' => DbQueue::class,
        'db' => 'db',
        'tableName' => '{{%queue}}',
        'channel' => 'default',
        'mutex' => MysqlMutex::class
    ],
    'redis' => [
        'class' => RedisQueue::class,
        'redis' => 'redis',
        'channel' => 'queue'
    ]
];

$config = $configs[env('QUEUE_DRIVER')];
$config['as log'] = LogBehavior::class;

return $config;
