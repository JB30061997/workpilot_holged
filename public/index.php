<?php

use Illuminate\Contracts\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(HttpKernel::class);
$request = Request::capture();
$response = $kernel->handle($request);

if (is_string($response->getContent())) {
    $response->headers->set('Content-Length', (string) strlen($response->getContent()));
}

// fastcgi_finish_request() drops the body on this server, so flush normally.
$response->send(flush: false);
flush();

$kernel->terminate($request, $response);
