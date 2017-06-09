<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=127.0.0.1;port=5432;dbname=resume',
    'username' => 'dbuser',
    'password' => '*100#pkjhflysq@987',
    'charset' => 'utf8',
    'schemaMap' => [
        'pgsql' => [
            'class' => \yii\db\pgsql\Schema::class,
            'defaultSchema' => 'video'
        ]
    ],
    'on afterOpen' => function ($event) {
        $event->sender->createCommand("SET search_path TO video;")->execute();
    },

];
