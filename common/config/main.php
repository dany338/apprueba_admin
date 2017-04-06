<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'es',
    'sourceLanguage' => 'en-US',
    'name' => 'CORECEINFES',
    'modules' => [
      'user' => [
            'class' => 'dektrium\user\Module',
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\RbacWebModule'
        ],
        /*'services' => [
            'basePath' => '@backend/models',
            'class' => 'backend\models'   // here is our v1 modules
        ]*/
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'components\MyManager',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => [
                        'userjson',
                        'carrerajson',
                        'categoriajson',
                        'colegiojson',
                        'configuracionjson',
                        'departamentojson',
                        'enunciadojson',
                        'imagenjson',
                        'municipiojson',
                        'opcionrespuestajson',
                        'paisjson',
                        'preguntajson',
                        'preguntapruebajson',
                        'profilejson',
                        'pruebaestudiantejson',
                        'pruebajson',
                        'respuestausuariojson',
                        'tipousuariojson',
                        'universidadjson'
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ]
                ],
            ],
        ],
    ],
];
