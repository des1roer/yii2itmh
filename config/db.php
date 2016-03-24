<?php

return [
    'prod' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=itmh', //prod - itmh, test - itmh_tests
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ],
    'test' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=itmh_tests', //prod - itmh, test - itmh_tests
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ],
];
