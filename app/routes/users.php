<?php
// PATH /messages
$app->path('users', function($request) use($app) {

    // GET (list all messages)
    $app->get(function($request) use($app) {

        $items = array(
            array(
                'id' => 1,
                'username' => 'vlucas',
                'password' => 'I hope you are not actually exposing this in your API...',
                'last_login' => time()
            ),
            array(
                'id' => 2,
                'username' => 'test',
                'name' => 'Chester Tester',
                'password' => 'I hope you are not actually exposing this in your API...',
                'last_login' => time()
            ),
            array(
                'id' => 3,
                'username' => 'test2',
                'name' => 'Testy McTesterpants',
                'password' => 'I hope you are not actually exposing this in your API...',
                'last_login' => time()
            )
        );

        $app->format('json', function($request) use($app, $items) {
            return $items;
        });
        $app->format('html', function($request) use($app, $items) {
            return $app->template('users/index', compact('items'));
        });
    });
});
