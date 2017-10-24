<?php return [
    'mysql' => function ($env) {
        $connection = \PdoModel\PdoFactory::createConnection($env['mysql']);
        $models = include 'models.php';
        return new \App\Base\ModelLocator($connection, $models);
    },

    'curlRequest' => new \App\Request\Curl(),
];