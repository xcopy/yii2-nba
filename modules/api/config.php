<?php

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'modules' => [
        'v1' => [
            'basePath' => '@api/modules/v1',
            'class' => 'app\modules\api\modules\v1\Module'
        ]
    ]
];
