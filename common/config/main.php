<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'queue' => [
            'class' => \yii\queue\db\Queue::className(),
            'db' => 'db', // Имя подключения к базе данных
            'tableName' => '{{%queue}}', // Название таблицы для очереди
            'channel' => 'default', // Канал очереди
            'mutex' => \yii\mutex\MysqlMutex::className(), // Мьютекс для безопасного выполнения
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'common\components\rbac\AuthManager',
            'itemFile' => '@common/components/rbac/items/items.php',
            'assignmentFile' => '@common/components/rbac/items/assignments.php',
            'ruleFile' => '@common/components/rbac/items/rules.php',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'timeZone' => 'Asia/Almaty',
            'dateFormat' => 'php:d.m.Y',
            'datetimeFormat' => 'php:d.m.Y H:i',
            'timeFormat' => 'php:H:i:s',
            'thousandSeparator' => '',
            'decimalSeparator' => '.',
        ],
        'assetManager' => [
            'linkAssets' => true,
            'appendTimestamp' => true
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],
    ],
];
