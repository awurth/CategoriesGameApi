<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

$loader = new AWurth\Config\ConfigurationLoader(__DIR__ . '/../var/cache/prod/config.php');
$loader->setParameters([
    'env'      => 'prod',
    'root_dir' => dirname(__DIR__)
]);

$app = new Slim\App($loader->getParameters());
$container = $app->getContainer();

$container['config'] = $loader->load(__DIR__ . '/../app/config/config.yml');

require __DIR__ . '/../app/dependencies.php';

require __DIR__ . '/../app/handlers.php';

require __DIR__ . '/../app/middleware.php';

require __DIR__ . '/../app/controllers.php';

require __DIR__ . '/../app/routes.php';

$app->run();
