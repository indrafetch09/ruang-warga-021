<?php

use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__ . '/../';
ini_set('session.cookie_httponly', 1); // Cegah JS baca cookie (Anti XSS)
ini_set('session.use_only_cookies', 1); // Cegah session ID lewat URL
ini_set('session.cookie_samesite', 'Lax'); // Cegah CSRF ringan

session_start();

require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . 'Core/functions.php';
require BASE_PATH . 'bootstrap.php';

$router = new \Core\Router();
require BASE_PATH . 'routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}

Session::unflash();
