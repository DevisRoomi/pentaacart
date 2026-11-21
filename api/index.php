<?php

// Prepare writable directories in /tmp for Vercel serverless environment
$directories = [
    '/tmp/views',
    '/tmp/storage',
    '/tmp/storage/app',
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

// Copy sqlite database to /tmp if it exists and is not yet in /tmp
$sourceDatabase = __DIR__.'/../database/database.sqlite';
$targetDatabase = '/tmp/database.sqlite';

if (file_exists($sourceDatabase) && (! file_exists($targetDatabase) || filesize($targetDatabase) === 0)) {
    @copy($sourceDatabase, $targetDatabase);
}

// Forward request to Laravel entry point
require __DIR__.'/../public/index.php';
