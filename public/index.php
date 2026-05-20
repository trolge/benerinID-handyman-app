<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Auto-fix storage symlink if broken
$link = __DIR__.'/storage';
$target = realpath(__DIR__.'/../storage/app/public');
if (!file_exists($link) || !is_dir($link)) {
    if (PHP_OS_FAMILY === 'Windows') {
        @exec('rmdir /s /q "' . $link . '" 2>nul');
        @exec('del /q /f "' . $link . '" 2>nul');
        @exec('mklink /J "' . $link . '" "' . $target . '"');
    } else {
        @unlink($link);
        @symlink($target, $link);
    }
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
