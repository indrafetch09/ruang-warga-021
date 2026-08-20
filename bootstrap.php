<?php

use Core\App;
use Core\Container;
use Core\Database;

// Load environment variables (.env) if present
if (file_exists(base_path('.env'))) {
    $dotenv = Dotenv\Dotenv::createUnsafeImmutable(base_path());
    $dotenv->safeLoad();
}

$container = new Container();

$container->bind('Core\Database', function () {
    $config = require base_path('config.php');
    $dbConfig = $config['database'];

    $username = $dbConfig['user'];
    $password = $dbConfig['password'];
    unset($dbConfig['user'], $dbConfig['password']);

    return new Database($dbConfig, $username, $password);
});

App::setContainer($container);
