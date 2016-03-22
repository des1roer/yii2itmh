<?php

$params = require(__DIR__ . '/params.php');
$mail = require(__DIR__ . '/local_mail.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'timezone' => 'Asia/Yekaterinburg',
    'modules' => [
        'user' => [
            'class' => 'amnah\yii2\user\Module',
            'emailConfirmation' => false,
        // set custom module properties here ...
        ],
        'video' => [
            'class' => 'app\modules\video\Module',
        ],
    ],
    'components' => [
        'request' => [
// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'S51X9l62nn_24iz05aB1p3Gf4Ml5q2dx',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'amnah\yii2\user\components\User',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
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
        /* 'mailer' => [
          'class' => 'yii\swiftmailer\Mailer',
          // send all mails to a file by default. You have to set
          // 'useFileTransport' to false and configure a transport
          // for the mailer to send real emails.
          'useFileTransport' => FALSE,
          'transport' => $mail['mail'],
          ], */
        'postman' => [
            'class' => 'rmrevin\yii\postman\Component',
            'driver' => 'smtp',
            'default_from' => ['mailer@somehost.com', 'Mailer'],
            'subject_prefix' => 'Sitename / ',
            'subject_suffix' => null,
            'table' => '{{%postman_letter}}',
            'view_path' => '/email',
            'smtp_config' => $mail['postman'],
        ],
        // 
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
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
