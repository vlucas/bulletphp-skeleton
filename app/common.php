<?php
// Setup defaults...
date_default_timezone_set('UTC');
error_reporting(-1); // Display ALL errors
ini_set('display_errors', '1');
ini_set("session.cookie_httponly", '1'); // Mitigate XSS javascript cookie attacks for browers that support it
ini_set("session.use_only_cookies", '1'); // Don't allow session_id in URLs

// ENV globals
define('BULLET_ENV', $request->env('BULLET_ENV', 'development'));

// Production setting switch
if(BULLET_ENV == 'production') {
    // Hide errors in production
    error_reporting(0);
    ini_set('display_errors', '0');
}

// Throw Exceptions for everything so we can see the errors
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
      throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}
set_error_handler("exception_error_handler");

// Start user session
session_start();

// Register helpers
$app->helper('form', 'App\Helper\Form');

// Shortcut to access $app instance anywhere
function app() {
    global $app;
    return $app;
}

// Display exceptions with error and 500 status
$app->on('Exception', function(\Bullet\Request $request, \Bullet\Response $response, \Exception $e) use($app) {
    if($request->format() === 'json') {
        $data = array(
            'error' => str_replace('Exception', '', get_class($e)),
            'message' => $e->getMessage()
        );

        // Debugging info for development ENV
        if(BULLET_ENV !== 'production') {
            $data['file'] = $e->getFile();
            $data['line'] = $e->getLine();
            $data['trace'] = $e->getTrace();
        }

        $response->content($data);
    } else {
        $response->content($app->template('errors/exception', array('e' => $e))->content());
    }

    if(BULLET_ENV === 'production') {
        // An error happened in production. You should really let yourself know about it.
        // TODO: Email, log to file, or send to error-logging service like Sentry, Airbrake, etc.
    }
});

// Custom 404 Error Page
$app->on(404, function(\Bullet\Request $request, \Bullet\Response $response) use($app) {
    $response->content($app->template('errors/404')->content());
});

// Super-simple language translation by key => value array
function t($string) {
    static $lang = null;
    static $langs = array();
    if($lang === null) {
        $lang = app()->request()->get('lang', 'en');
        if(!preg_match("/^[a-z]{2}$/", $lang)) {
            throw new \Exception("Language must be a-z and only two characters");
        }
    }
    if(!isset($langs[$lang])) {
        $langFile = __DIR__ . '/lang/' . $lang . '.php';
        if(!file_exists($langFile)) {
            throw new \Exception("Language '$lang' not supported. Sorry :(");
        }
        $langs[$lang] = require($langFile);
    }

    if(isset($langs[$lang][$string])) {
        return $langs[$lang][$string];
    }
    return $string;
}

