<?php
// Composer Autoloader
$loader = require __DIR__ . '/vendor/autoload.php';
$loader->add('Entity', __DIR__ . '/src/'); // Entities
$loader->add('App', __DIR__ . '/lib/'); // Custom app/lib files

// Directories
$srcDir = __DIR__ . '/src/';
$apiDir = $srcDir . '/routes/';

// Bullet App
$app = new Bullet\App(require $srcDir . 'config.php');
$request = new Bullet\Request();

// Common include
require $srcDir . '/common.php';

// Require all paths/routes
require $apiDir . 'index.php';
require $apiDir . 'events.php';

// CLI routes
if($request->isCli()) {
    require $apiDir . 'db.php';
}

// Response
echo $app->run($request);
