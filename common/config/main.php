<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'request' => array(
            'baseUrl' => 'http://adm.aduinaja.com',
        ),
    ],
];
