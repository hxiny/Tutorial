<?php
//return [
//    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
//    'components' => [
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
//        'db' => [
//            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=139.224.164.241;dbname=cell',
//            'username' => 'root',
//            'password' => '123456',
//            'charset' => 'utf8'
//        ]
//    ],
//];
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=106.14.21.180;dbname=cell',
            'username' => 'root',
            'password' => 'Lifeng_8878260',
            'charset' => 'utf8mb4'
        ]
    ],
];