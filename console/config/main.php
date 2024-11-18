<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'queue'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
        'queue' => [
            'class' => \yii\queue\cli\Command::className(),
            'queue' => 'queue', // ID компонента очереди, совпадает с именем компонента в 'components'
        ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'queue' => [
            'class' => \yii\queue\db\Queue::className(),
            'db' => 'db', // Имя подключения к базе данных
            'tableName' => '{{%queue}}', // Название таблицы для очереди
            'channel' => 'default', // Канал очереди
            'mutex' => \yii\mutex\MysqlMutex::className(), // Мьютекс для безопасного выполнения
        ],
        'mutex' => [
            'class' => \yii\mutex\MysqlMutex::className(),
        ],
    ],
    'params' => $params,
];
