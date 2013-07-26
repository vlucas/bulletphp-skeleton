<?php
define('BULLET_ROOT', dirname(__DIR__));
define('BULLET_APP_ROOT', BULLET_ROOT . '/app/');
define('BULLET_SRC_ROOT', BULLET_APP_ROOT . '/src/');

// Composer Autoloader
$loader = require BULLET_ROOT . '/vendor/autoload.php';

// Bullet App
$app = new Bullet\App(require BULLET_APP_ROOT . 'config.php');
$request = new Bullet\Request();

// Common include
require BULLET_APP_ROOT . '/common.php';

// Require all paths/routes
$routesDir = BULLET_APP_ROOT . '/routes/';
require $routesDir . 'index.php';
require $routesDir . 'events.php';
require $routesDir . 'messages.php';
require $routesDir . 'users.php';

// CLI routes
if($request->isCli()) {
    require $routesDir . 'db.php';
}

// Response
echo $app->run($request);

