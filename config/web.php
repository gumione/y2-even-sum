<?php
declare(strict_types=1);

use yii\web\Response;

$params = require __DIR__ . '/params.php';

return [
    'id' => 'yii2-even-sum-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    
    'container' => [
        'definitions' => [
            \app\services\interfaces\SumCalculatorInterface::class
                => \app\services\EvenSumCalculator::class,
        ],
    ],

    'components' => [
        'cache' => [
            'class' => yii\caching\FileCache::class,
        ],

        'request' => [
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => yii\web\JsonParser::class,
            ],
        ],

        'urlManager' => [
            'enablePrettyUrl'      => true,
            'showScriptName'       => false,
            'enableStrictParsing'  => true,
            'rules' => [
                'POST   sum-even'    => 'sum/index',
                'OPTIONS sum-even'   => 'sum/options',
                'GET   swagger'      => 'swagger/index',
                'GET   swagger/json' => 'swagger/json',
            ],
        ],

        'response' => [
            'format' => Response::FORMAT_JSON,
        ],
        
        'user' => [
            'identityClass' => IdentityInterface::class,
            'enableSession' => false,
            'loginUrl'      => null,
        ],

        'log' => [
            'targets' => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    'params' => $params,
];
