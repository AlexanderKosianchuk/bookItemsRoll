<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
	'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'languageSwitcher'],
	'defaultRoute' => 'book/index',
    'components' => [
    	'assetManager' => [
    		'bundles' => false,
    	],
        'request' => [
            'cookieValidationKey' => '1hezUTdz9HiMT7vnsNkKA8oe44laJq2l',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
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
    	'i18n' => [
    		'translations' => [
    			'app*' => [
    				'class' => 'yii\i18n\PhpMessageSource',
    				'basePath' => '@app/messages',
    				'sourceLanguage' => 'en-EN',
    				'fileMap' => [
    					'app' => 'app.php',
    					'app/error' => 'error.php',
    				],
    				'on missingTranslation' =>
    				['app\components\TranslationEventHandler',
    					'handleMissingTranslation']
    				],
    			],
    	],
    	'languageSwitcher' => [
    		'class' => 'app\components\LanguageSwitcher',
    	],
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
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
