<?php

$params = require(__DIR__ . '/params.php');
$mail = require(__DIR__ . '/local_mail.php');
$db = require(__DIR__ . '/db.php');

//$test = true;
$db = ($test) ? $db['test'] : $db['prod'];

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'timezone' => 'Asia/Yekaterinburg',
    'modules' => [
        'user' => [
            'class' => 'amnah\yii2\user\Module',
        ],
        'video' => [
            'class' => 'app\modules\video\Module',
            'as access' => [ // if you need to set access
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'] // all auth users
                    ],
                ]
            ],
        ],
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [ //I:\OpenServer\domains\yii2itmh\vendor\amnah\yii2-user\views\default\login.php
                    '@vendor/amnah/yii2-user/views' => '@app/views/user',
                ],
            ],
        ],
        'request' => [
// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'S51X9l62nn_24iz05aB1p3Gf4Ml5q2dx',
            'baseUrl' => '',
        ],
        'image' =>
        [
            'class' => 'intervention\image\src\Intervention\Image\ImageManagerStatic',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'amnah\yii2\user\components\User',
        ],
        /* 'user' => [
          'identityClass' => 'app\models\User',
          'enableAutoLogin' => true,
          ], */
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => FALSE,
            'messageConfig' => [
                'from' => ['admin@website.com' => 'Admin'], // this is needed for sending emails
                'charset' => 'UTF-8',
            ],
            'transport' => $mail['mail'],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV)
{
// configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
