<?php

$params = require __DIR__.'/params.php';
$db = require __DIR__.'/db.php';

$config = [
    'id'           => 'basic',
    'language'     => 'ru-RU',
    'basePath'     => dirname(__DIR__),
    'bootstrap'    => ['log'],
    'aliases'      => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components'   => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],

        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'mtE2xqSfDJy8p9OnmJVyL3Kv6QxXXUzE',
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'         => [
            'identityClass'   => 'app\models\Users',
            'enableAutoLogin' => true,

        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer'       => [
            'class'            => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db'           => $db,

        'urlManager' => [

            'enablePrettyUrl' => true,
            'showScriptName'  => false,


            'rules' => [

                'tasks/view/<id:\d+>'                                                                                                                                                                                                                                             => 'tasks/view',
                'user/view/<id:\d+>'                                                                                                                                                                                                                                              => 'user/view',
                'tasks/download/<fileId:\d+>'                                                                                                                                                                                                                                     => 'tasks/download',
                'tasks/cancel/<taskId:\d+>'                                                                                                                                                                                                                                       => 'tasks/cancel',
                'tasks/respond/<taskId:\d+>/<executorId:\d+>'                                                                                                                                                                                                                     => 'tasks/respond',
                'tasks/refuse/<taskId:\d+>'                                                                                                                                                                                                                                       => 'tasks/refuse',
                'tasks/done/<taskId:\d+>'                                                                                                                                                                                                                                         => 'tasks/done',
                'tasks/rejected/<taskId:\d+>/<executorId:\d+>/<isRejected:\d+>'                                                                                                                                                                                                   => 'tasks/rejected',
                'tasks/page/<page:\d+>/tasks/index/' => 'tasks/index',


            ],

        ],


    ],
    'params'       => $params,
    'defaultRoute' => 'landing/index',

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class'      => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class'      => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*', '::1'],
    ];
}

return $config;
