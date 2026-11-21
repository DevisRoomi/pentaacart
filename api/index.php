<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Prepare writable directories in /tmp for Vercel serverless environment
$directories = [
    '/tmp/views',
    '/tmp/storage',
    '/tmp/storage/app',
    '/tmp/storage/app/public',
    '/tmp/storage/framework',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($directories as $dir) {
    if (! is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}

// Copy sqlite database to /tmp so SQLite is writable & accessible in serverless
$sourceDatabase = __DIR__.'/../database/database.sqlite';
$targetDatabase = '/tmp/database.sqlite';

if (file_exists($sourceDatabase) && (! file_exists($targetDatabase) || filesize($targetDatabase) === 0)) {
    @copy($sourceDatabase, $targetDatabase);
}

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->useStoragePath('/tmp/storage');

$app->handleRequest(Request::capture());
