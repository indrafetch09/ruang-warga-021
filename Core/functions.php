<?php

use Core\Response;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }

    return true;
}

function base_path($path = '')
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    // ponytail: resolution logic for filtered user/ and admin/ views architecture
    $fullPath = base_path('views/' . $path);
    if (!file_exists($fullPath)) {
        if (file_exists(base_path('views/user/' . $path))) {
            $fullPath = base_path('views/user/' . $path);
        } elseif (file_exists(base_path('views/admin/' . $path))) {
            $fullPath = base_path('views/admin/' . $path);
        }
    }

    require $fullPath;
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}

function csrf_token()
{
    if (! \Core\Session::has('csrf_token')) {
        \Core\Session::put('csrf_token', bin2hex(random_bytes(32)));
    }
    return \Core\Session::get('csrf_token');
}

function csrf_field()
{
    $token = csrf_token();
    return "<input type='hidden' name='_token' value='{$token}'>";
}

function env($key, $default = null)
{
    $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);

    if ($value === false || $value === null) {
        return $default;
    }

    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
        case 'empty':
        case '(empty)':
            return '';
        case 'null':
        case '(null)':
            return null;
    }

    return $value;
}
