<?php

return [
    'id' => 'api',
    'modules' => [
        'v1' => [
            'basePath' => '@api/modules/v1',
            'class' => 'app\modules\api\modules\v1\Module'
        ]
    ]
];
