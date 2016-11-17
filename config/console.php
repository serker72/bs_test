<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
	'parser' => [
            'class' => 'app\components\ParserKrdAntiagent',
            'host' => 'http://krd.antiagent.ru/index.html?',
            'curlOpt' => [
                'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.57 Safari/537.36',
                'header' => [
                        'Accept: text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1',
                        'Accept-Language: en-US,en;q=0.8,ru;q=0.6,uk;q=0.4',
                        'Accept-Charset: Windows-1251, utf-8, *;q=0.1',
                        'Accept-Encoding: deflate, identity, *;q=0',
                ]
            ]
	],        
        
    ],
    'params' => $params,
    
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
        'hello' => [ // Fixture generation command line.
            'class' => 'app\commands\HelloController',
        ],
    ],
    
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
